const Auth = {
    init: function() {
        if (!localStorage.getItem('users')) {
            localStorage.setItem('users', JSON.stringify([]));
        }
    },
    register: function(username, email, password) {
        this.init();
        const users = JSON.parse(localStorage.getItem('users'));
        if (users.find(u => u.username === username || u.email === email)) {
            return { success: false, message: 'Username or email already exists' };
        }
        users.push({ username, email, password });
        localStorage.setItem('users', JSON.stringify(users));
        return { success: true, message: 'Registration successful' };
    },
    login: function(username, password) {
        this.init();
        const users = JSON.parse(localStorage.getItem('users'));
        const user = users.find(u => u.username === username && u.password === password);
        if (user) {
            localStorage.setItem('currentUser', JSON.stringify({ username: user.username, email: user.email }));
            return { success: true, message: 'Login successful' };
        }
        return { success: false, message: 'Invalid credentials' };
    },
    logout: function() {
        localStorage.removeItem('currentUser');
        window.location.reload();
    },
    isLoggedIn: function() {
        return localStorage.getItem('currentUser') !== null;
    },
    getCurrentUser: function() {
        return JSON.parse(localStorage.getItem('currentUser'));
    },
    requireAuth: function() {
        if (!this.isLoggedIn()) {
            window.location.href = 'Login.html';
        }
    },
    renderAuthUI: function() {
        const authContainer = document.getElementById('auth-container');
        if (!authContainer) return;
        if (this.isLoggedIn()) {
            const user = this.getCurrentUser();
            authContainer.innerHTML = `
                <div class="d-flex align-items-center justify-content-end p-3 position-absolute top-0 end-0 w-100" style="z-index: 10;">
                    <a href="Contact.html" class="text-white me-3 fw-bold text-decoration-none">Contact</a>
                    <span class="text-white me-3 fw-bold">Welcome, ${user.username}!</span>
                    <button onclick="Auth.logout()" class="btn btn-dark btn-sm rounded-pill px-3">Logout</button>
                </div>
            `;
        } else {
            authContainer.innerHTML = `
                <div class="d-flex justify-content-end p-3 position-absolute top-0 end-0 w-100 align-items-center" style="z-index: 10;">
                    <a href="Contact.html" class="text-white me-3 fw-bold text-decoration-none d-flex align-items-center">Contact</a>
                    <a href="Login.html" class="btn btn-dark btn-sm rounded-pill px-3 me-2">Login</a>
                    <a href="Register.html" class="btn btn-light btn-sm rounded-pill px-3 text-dark fw-bold">Register</a>
                </div>
            `;
        }
    }
};

document.addEventListener('DOMContentLoaded', () => {
    Auth.renderAuthUI();
});
