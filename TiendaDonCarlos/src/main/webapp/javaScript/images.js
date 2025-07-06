export const images = Array.from({ length: 553 }, (_, i) => {
  const frameNumber = String(i + 1).padStart(4, '0');
  return {
    p: `frames/frame_${frameNumber}.webp`
  };
});
