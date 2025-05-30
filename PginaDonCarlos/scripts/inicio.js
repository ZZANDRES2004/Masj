// auth.js - Sistema de autenticación completo
class AuthSystem {
    constructor() {
        this.initializeDefaultUsers();
    }

    // Función para hash de contraseña
    hashPassword(password) {
        let hash = 0;
        for (let i = 0; i < password.length; i++) {
            const char = password.charCodeAt(i);
            hash = ((hash << 5) - hash) + char;
            hash = hash & hash;
        }
        return Math.abs(hash).toString();
    }

    // Crear usuarios predeterminados
    initializeDefaultUsers() {
        const existingUsers = localStorage.getItem('users');
        
        if (!existingUsers) {
            const defaultUsers = [
                {
                    id: 1,
                    username: "admin",
                    email: "admin@doncarlos.com",
                    password: "Admin123",
                    role: "admin",
                    name: "Administrador",
                    redirectUrl: "admin_dashboard.html"
                },
                {
                    id: 2,
                    username: "empleado",
                    email: "empleado@doncarlos.com",
                    password: "Emp123",
                    role: "employee",
                    name: "Empleado Principal",
                    redirectUrl: "employee_dashboard.html"
                },
                {
                    id: 3,
                    username: "cliente1",
                    email: "cliente1@gmail.com",
                    password: "Cliente123",
                    role: "customer",
                    name: "Juan Pérez",
                    redirectUrl: "customer_dashboard.html"
                },
                {
                    id: 4,
                    username: "vendedor",
                    email: "vendedor@doncarlos.com",
                    password: "Vend123",
                    role: "seller",
                    name: "Carlos Vendedor",
                    redirectUrl: "seller_dashboard.html"
                }
            ];

            // Crear usuarios con contraseñas hasheadas
            const users = defaultUsers.map(user => ({
                id: user.id,
                username: user.username,
                email: user.email,
                password: this.hashPassword(user.password),
                role: user.role,
                name: user.name,
                redirectUrl: user.redirectUrl,
                createdAt: new Date().toISOString(),
                isActive: true
            }));

            localStorage.setItem('users', JSON.stringify(users));
            
            console.log('✅ Usuarios predeterminados creados:');
            defaultUsers.forEach(user => {
                console.log(`👤 ${user.role.toUpperCase()}: ${user.username} / ${user.email} / ${user.password}`);
            });
        } else {
            console.log('ℹ️ Usuarios ya existentes en el sistema');
        }
    }

    // Validar login
    login(usernameOrEmail, password) {
        try {
            if (!usernameOrEmail || !password) {
                throw new Error('Usuario/email y contraseña son requeridos');
            }

            const users = JSON.parse(localStorage.getItem('users')) || [];
            const hashedPassword = this.hashPassword(password);
            
            const user = users.find(u => 
                (u.username === usernameOrEmail || u.email === usernameOrEmail) &&
                u.password === hashedPassword && 
                u.isActive
            );
            
            if (!user) {
                throw new Error('Credenciales incorrectas o usuario inactivo');
            }

            // Guardar sesión actual
            const sessionUser = {
                id: user.id,
                username: user.username,
                email: user.email,
                role: user.role,
                name: user.name,
                redirectUrl: user.redirectUrl,
                loginTime: new Date().toISOString()
            };

            localStorage.setItem('currentUser', JSON.stringify(sessionUser));

            return {
                success: true,
                message: 'Inicio de sesión exitoso',
                user: sessionUser
            };

        } catch (error) {
            return {
                success: false,
                message: error.message
            };
        }
    }

    // Registrar nuevo usuario (cliente)
    register(userData) {
        try {
            const { name, email, password, direccion, telefono, documento, fecha } = userData;
            
            if (!name || !email || !password) {
                throw new Error('Nombre, email y contraseña son requeridos');
            }

            const users = JSON.parse(localStorage.getItem('users')) || [];
            
            // Verificar si el usuario ya existe
            const existingUser = users.find(user => 
                user.username === email || user.email === email
            );

            if (existingUser) {
                throw new Error('El email ya está registrado');
            }

            // Crear nuevo usuario cliente
            const newUser = {
                id: Date.now(),
                username: email, // Usar email como username
                email: email,
                password: this.hashPassword(password),
                role: "customer",
                name: name,
                direccion: direccion,
                telefono: telefono,
                documento: documento,
                fecha: fecha,
                redirectUrl: "customer_dashboard.html",
                createdAt: new Date().toISOString(),
                isActive: true
            };

            users.push(newUser);
            localStorage.setItem('users', JSON.stringify(users));

            return {
                success: true,
                message: 'Usuario registrado exitosamente',
                user: {
                    id: newUser.id,
                    username: newUser.username,
                    email: newUser.email,
                    name: newUser.name,
                    role: newUser.role
                }
            };

        } catch (error) {
            return {
                success: false,
                message: error.message
            };
        }
    }

    // Verificar sesión actual
    getCurrentUser() {
        const currentUser = localStorage.getItem('currentUser');
        return currentUser ? JSON.parse(currentUser) : null;
    }

    // Cerrar sesión
    logout() {
        localStorage.removeItem('currentUser');
        return {
            success: true,
            message: 'Sesión cerrada exitosamente'
        };
    }

    // Verificar si está logueado
    isLoggedIn() {
        return this.getCurrentUser() !== null;
    }
}

// Inicializar sistema de autenticación
const auth = new AuthSystem();

// Función para manejar el login
function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const result = auth.login(email, password);
    
    if (result.success) {
        alert(`¡Bienvenido ${result.user.name}!`);
        console.log('Usuario logueado:', result.user);
        
        // Redirigir según el rol del usuario
        setTimeout(() => {
            window.location.href = result.user.redirectUrl;
        }, 1000);
        
    } else {
        alert('Error: ' + result.message);
    }
}

// Función para manejar el registro
function handleRegister(event) {
    event.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        direccion: document.getElementById('direccion').value,
        telefono: document.getElementById('telefono').value,
        documento: document.getElementById('documento').value,
        fecha: document.getElementById('fecha').value
    };

    const result = auth.register(formData);
    
    if (result.success) {
        alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
        setTimeout(() => {
            window.location.href = 'login.html';
        }, 1000);
    } else {
        alert('Error: ' + result.message);
    }
}

// Función para verificar autenticación en páginas protegidas
function checkAuth(requiredRole = null) {
    const currentUser = auth.getCurrentUser();
    
    if (!currentUser) {
        alert('Debes iniciar sesión para acceder a esta página');
        window.location.href = 'login.html';
        return false;
    }
    
    if (requiredRole && currentUser.role !== requiredRole) {
        alert('No tienes permisos para acceder a esta página');
        window.location.href = getCurrentUserDashboard();
        return false;
    }
    
    return currentUser;
}

// Obtener dashboard según rol del usuario
function getCurrentUserDashboard() {
    const currentUser = auth.getCurrentUser();
    if (!currentUser) return 'login.html';
    
    const dashboards = {
        'admin': 'admin_dashboard.html',
        'employee': 'employee_dashboard.html',
        'customer': 'customer_dashboard.html',
        'seller': 'seller_dashboard.html'
    };
    
    return dashboards[currentUser.role] || 'customer_dashboard.html';
}

// Función para cerrar sesión
function handleLogout() {
    const result = auth.logout();
    alert(result.message);
    window.location.href = 'inicio.html';
}

// Exportar para uso global
window.auth = auth;
window.handleLogin = handleLogin;
window.handleRegister = handleRegister;
window.checkAuth = checkAuth;
window.handleLogout = handleLogout;