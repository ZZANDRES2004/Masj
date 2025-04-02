import pyaudio
import wave
import numpy as np
import librosa
import librosa.display
import matplotlib.pyplot as plt
import scipy.signal as signal
import soundfile as sf
import cv2
from skimage.metrics import structural_similarity as ssim

# Parámetros de grabación
FORMAT = pyaudio.paInt16
CHANNELS = 1
RATE = 48000  # Frecuencia de muestreo
CHUNK = 1024
RECORD_SECONDS = 5  # Duración de la grabación
OUTPUT_FILENAME = "voice_record.wav"

def record_audio():
    """
    Graba audio del micrófono y lo guarda en un archivo WAV.
    """
    audio = pyaudio.PyAudio()
    
    print("Preparando para grabar...")
    stream = audio.open(format=FORMAT, channels=CHANNELS, rate=RATE, input=True, frames_per_buffer=CHUNK)
    
    print("Grabando... (duración: {} segundos)".format(RECORD_SECONDS))
    frames = []
    
    for i in range(0, int(RATE / CHUNK * RECORD_SECONDS)):
        data = stream.read(CHUNK)
        frames.append(data)
        # Mostrar progreso cada segundo
        if i % int(RATE / CHUNK) == 0 and i > 0:
            print(f"Tiempo transcurrido: {i/(RATE/CHUNK)} segundos")
    
    print("Grabación finalizada.")
    
    stream.stop_stream()
    stream.close()
    audio.terminate()
    
    # Guardar el audio en un archivo WAV
    print(f"Guardando archivo: {OUTPUT_FILENAME}")
    with wave.open(OUTPUT_FILENAME, 'wb') as wf:
        wf.setnchannels(CHANNELS)
        wf.setsampwidth(audio.get_sample_size(FORMAT))
        wf.setframerate(RATE)
        wf.writeframes(b''.join(frames))
    
    print(f"Audio guardado correctamente en '{OUTPUT_FILENAME}'")
    return OUTPUT_FILENAME

def load_audio(filename):
    """
    Carga un archivo de audio y lo convierte a formato adecuado.
    """
    print(f"Cargando archivo de audio: {filename}")
    audio, sr = librosa.load(filename, sr=RATE, mono=True)
    return audio, sr

def compute_spectrogram(audio, sr):
    """
    Calcula el espectrograma de la señal de audio.
    """
    print("Calculando espectrograma...")
    # Configurar parámetros STFT para mejor resolución
    n_fft = 2048
    hop_length = 512
    
    # Calcular STFT
    D = librosa.stft(audio, n_fft=n_fft, hop_length=hop_length)
    
    return D

def plot_spectrogram(D, sr, title="Espectrograma", filename="spectrogram.png"):
    """
    Visualiza y guarda el espectrograma como imagen.
    """
    plt.figure(figsize=(12, 6))
    
    # Convertir a dB para mejor visualización
    S_db = librosa.amplitude_to_db(np.abs(D), ref=np.max)
    
    # Mostrar el espectrograma
    librosa.display.specshow(S_db, sr=sr, y_axis='log', x_axis='time', cmap='coolwarm')
    plt.colorbar(format='%+2.0f dB')
    plt.title(title)
    plt.tight_layout()
    
    # Guardar como imagen
    plt.savefig(filename)
    print(f"Espectrograma guardado como '{filename}'")
    plt.close()
    
    return S_db

def enhance_spectrogram(D):
    """
    Mejora el espectrograma utilizando técnicas de procesamiento de imágenes.
    """
    print("Mejorando espectrograma con técnicas de procesamiento de imágenes...")
    
    # Convertir magnitudes a dB para procesamiento
    D_db = librosa.amplitude_to_db(np.abs(D), ref=np.max)
    
    # Normalizar valores para procesamiento de imagen (0-255)
    D_min = np.min(D_db)
    D_max = np.max(D_db)
    D_norm = ((D_db - D_min) / (D_max - D_min) * 255).astype(np.uint8)
    
    # 1. Ecualización de histograma para mejorar el contraste
    D_eq = cv2.equalizeHist(D_norm)
    
    # 2. Aplicar filtro bilateral para preservar bordes y reducir ruido
    D_bilateral = cv2.bilateralFilter(D_eq, d=5, sigmaColor=75, sigmaSpace=75)
    
    # 3. Ajuste de contraste adaptativo (CLAHE)
    clahe = cv2.createCLAHE(clipLimit=2.0, tileGridSize=(8, 8))
    D_clahe = clahe.apply(D_bilateral)
    
    # 4. Filtrado de mediana para reducir el ruido de impulso
    D_median = cv2.medianBlur(D_clahe, 3)
    
    # 5. Realce de bordes con un filtro unsharp mask
    gaussian = cv2.GaussianBlur(D_median, (0, 0), 3.0)
    D_unsharp = cv2.addWeighted(D_median, 1.5, gaussian, -0.5, 0)
    
    # Convertir de vuelta al rango original
    D_processed_db = (D_unsharp / 255.0) * (D_max - D_min) + D_min
    
    # Convertir de dB a magnitud lineal
    D_processed_mag = librosa.db_to_amplitude(D_processed_db)
    
    # Mantener la fase original del espectrograma
    D_enhanced = D_processed_mag * np.exp(1j * np.angle(D))
    
    return D_enhanced

def reconstruct_audio(D_enhanced, hop_length=512):
    """
    Reconstruye la señal de audio a partir del espectrograma mejorado.
    """
    print("Reconstruyendo audio a partir del espectrograma mejorado...")
    return librosa.istft(D_enhanced, hop_length=hop_length)

def save_audio(filename, audio, sr):
    """
    Guarda la señal de audio en un archivo.
    """
    # Normalizar para evitar clipping
    audio = audio / np.max(np.abs(audio))
    sf.write(filename, audio, sr)
    print(f"Audio guardado como '{filename}'")

def evaluate_improvement(original, enhanced, D_original, D_enhanced):
    """
    Evalúa la mejora conseguida en términos de métricas objetivas.
    """
    # Asegurar misma longitud
    min_len = min(len(original), len(enhanced))
    original = original[:min_len]
    enhanced = enhanced[:min_len]
    
    # Normalizar
    original = original / np.max(np.abs(original))
    enhanced = enhanced / np.max(np.abs(enhanced))
    
    # Calcular SNR
    noise = original - enhanced
    snr = 10 * np.log10(np.sum(original**2) / np.sum(noise**2))
    
    # Calcular SSIM en espectrogramas
    original_db = librosa.amplitude_to_db(np.abs(D_original), ref=np.max)
    enhanced_db = librosa.amplitude_to_db(np.abs(D_enhanced), ref=np.max)
    
    # Normalizar para SSIM
    original_norm = (original_db - np.min(original_db)) / (np.max(original_db) - np.min(original_db))
    enhanced_norm = (enhanced_db - np.min(enhanced_db)) / (np.max(enhanced_db) - np.min(enhanced_db))
    
    ssim_value = ssim(original_norm, enhanced_norm, data_range=1.0)
    
    return snr, ssim_value

def main():
    try:
        # 1. Grabar audio
        record_audio()
        
        # 2. Cargar audio
        audio, sr = load_audio(OUTPUT_FILENAME)
        
        # 3. Calcular espectrograma
        D_original = compute_spectrogram(audio, sr)
        
        # 4. Visualizar espectrograma original
        plot_spectrogram(D_original, sr, "Espectrograma Original", "original_spectrogram.png")
        
        # 5. Mejorar espectrograma
        D_enhanced = enhance_spectrogram(D_original)
        
        # 6. Visualizar espectrograma mejorado
        plot_spectrogram(D_enhanced, sr, "Espectrograma Mejorado", "enhanced_spectrogram.png")
        
        # 7. Reconstruir audio
        enhanced_audio = reconstruct_audio(D_enhanced)
        
        # 8. Guardar audio mejorado
        save_audio("enhanced_audio.wav", enhanced_audio, sr)
        
        # 9. Evaluar mejora
        snr, ssim_value = evaluate_improvement(audio, enhanced_audio, D_original, D_enhanced)
        
        print("\nResultados:")
        print(f"SNR: {snr:.2f} dB")
        print(f"SSIM entre espectrogramas: {ssim_value:.4f}")
        
        print("\nProceso completado con éxito.")
        print("Archivos generados:")
        print("- voice_record.wav: Audio original grabado")
        print("- original_spectrogram.png: Espectrograma del audio original")
        print("- enhanced_spectrogram.png: Espectrograma mejorado")
        print("- enhanced_audio.wav: Audio reconstruido a partir del espectrograma mejorado")
        
    except Exception as e:
        print(f"Error durante la ejecución: {e}")
        import traceback
        traceback.print_exc()

if __name__ == "__main__":
    main()