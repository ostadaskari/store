/******************************************************
 * 📁 File: auth-handler.js
 * 📌 Purpose: Manage sign-up, login, form transitions,
 *            field validation, and UI interactions.
 ******************************************************/
//____________________________________________________
//            js code for three
// ___________________________________________________
import * as THREE from "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js";

window.onload = function() {
    const scene = new THREE.Scene();

    // Camera
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth/window.innerHeight, 0.1, 1000);
    camera.position.z = 5;

    // Renderer
    // Renderer
    const renderer = new THREE.WebGLRenderer({
        canvas: document.getElementById("bg"),
        alpha: true, // Transparent background
        antialias: true
    });
    renderer.setClearColor(0x000000, 0);
    renderer.setSize(window.innerWidth, window.innerHeight);


    // Stars (particles)
    const starsCount = 2000;
    const positions = new Float32Array(starsCount * 3);
    const colors = new Float32Array(starsCount * 3);

    for(let i = 0; i < starsCount * 3; i += 3) {
        // Random positions in 3D space
        positions[i] = (Math.random() - 0.5) * 100;
        positions[i+1] = (Math.random() - 0.5) * 100;
        positions[i+2] = (Math.random() - 0.5) * 100;

        // Star colors: white, light blue, soft yellow
        const r = Math.random() * 0.5 + 0.5;
        const g = Math.random() * 0.5 + 0.5;
        const b = Math.random() * 0.5 + 0.5;
        colors[i] = r;
        colors[i+1] = g;
        colors[i+2] = b;
    }

    const starsGeometry = new THREE.BufferGeometry();
    starsGeometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    starsGeometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));

    const starsMaterial = new THREE.PointsMaterial({
        size: 0.1,
        vertexColors: true,
        transparent: true,
        opacity: 0.8
    });

    const stars = new THREE.Points(starsGeometry, starsMaterial);
    scene.add(stars);

    // Galaxy / Nebula effect (optional)
    const nebulaGeometry = new THREE.SphereGeometry(50, 32, 32);
    const nebulaMaterial = new THREE.MeshBasicMaterial({
        color: 0x222244,
        side: THREE.BackSide,
        transparent: true,
        opacity: 0.2
    });
    const nebula = new THREE.Mesh(nebulaGeometry, nebulaMaterial);
    scene.add(nebula);

    // Animate
    function animate() {
        requestAnimationFrame(animate);

        // Slowly rotate stars for a space feeling
        stars.rotation.y += 0.0005;
        stars.rotation.x += 0.0002;

        renderer.render(scene, camera);
    }
    animate();

    // Handle window resize
    window.addEventListener("resize", () => {
        renderer.setSize(window.innerWidth, window.innerHeight);
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
    });
};

/* ================================
   🔁 Panel Toggle (Sign In)
================================== */
const container = document.getElementById("containerLogin");
const signIn = document.getElementById("signIn");

signIn.addEventListener("click", () => {
  container.classList.remove("left-panel-active");
  container.classList.add("right-panel-active");
});

/* ================================
   🔙 Go Back to Overlay
================================== */
function goBackToOverlay() {
  container.classList.remove("left-panel-active", "right-panel-active");
}
const backIcon = document.getElementById("goBackToOverlay");

backIcon.addEventListener("click", goBackToOverlay);

/* ================================
   🧾  Login Logic
================================== */
document.addEventListener('DOMContentLoaded', function () {

  // // 👉 Login Form Submission
  // document.getElementById('loginForm').addEventListener('submit', function (e) {
  //   e.preventDefault();
  //
  //   // 📥 Inputs
  //   const loginUsernameInput = document.getElementById('userName');
  //   const loginPasswordInput = document.getElementById('password');
  //
  //   const loginUsername = loginUsernameInput.value.trim();
  //   const loginPassword = loginPasswordInput.value.trim();
  //
  //   // 🔍 Search for user
  //   const storedUsers = JSON.parse(localStorage.getItem('users')) || [];
  //   const user = storedUsers.find(
  //     user => user.username === loginUsername && user.password === loginPassword
  //   );
  //
  //   if (user) {
  //     alert('ورود با موفقیت انجام شد!');
  //     localStorage.setItem('loggedInUsername', user.username);
  //     console.log('Saved loggedInUsername:', localStorage.getItem('loggedInUsername'));
  //     window.location.href = 'user.html';
  //   } else {
  //     alert('کاربری با این مشخصات یافت نشد.');
  //     loginUsernameInput.value = '';
  //     loginPasswordInput.value = '';
  //   }
  // });

  // ✅ Mobile Number Validation
  function validateMobile(mobile) {
    const regex = /^09\d{9}$/;
    return regex.test(mobile);
  }

  // ✅ Password Validation
  function validatePassword(password) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>]).{8,}$/.test(password);
  }

});

/* ================================
   👁 Toggle Password Visibility
================================== */
const togglePasswords = document.querySelectorAll('.togglePassword');
togglePasswords.forEach(togglePassword => {
  const passwords = document.querySelectorAll('.passwordId');
  togglePassword.addEventListener('click', function () {
    passwords.forEach(password => {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
    });

    const icon = this.querySelector('i');
    if (icon) {
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    } else {
      console.warn('آیکون داخل عنصر togglePassword پیدا نشد.');
    }
  });
});

/* ================================
   🧼 Bootstrap Validation
================================== */
(() => {
  'use strict';
  const forms = document.querySelectorAll('.needs-validation');
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
    }, false);
  });
})();
