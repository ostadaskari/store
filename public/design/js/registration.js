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


//____________________________________________________
//            js code for forms
// ___________________________________________________
/* ==========================
   Provinces & Cities Data
   ========================== */
const provincesAndCities = {
    "تهران": ["تهران", "ری", "شمیرانات", "اسلامشهر", "پردیس", "فشم", "دماوند", "کمال‌شهر"],
    "اصفهان": ["اصفهان", "کاشان", "نجف‌آباد", "خمینی‌شهر", "آران و بیدگل", "شهرضا", "فلاورجان", "مبارکه"],
    "فارس": ["شیراز", "مرودشت", "کازرون", "جهرم", "فیروزآباد", "کوار", "سپیدان", "لامرد"],
    "خراسان رضوی": ["مشهد", "نیشابور", "سبزوار", "گناباد", "تربت حیدریه", "چناران", "کاشمر", "فریمان"],
    "آذربایجان شرقی": ["تبریز", "مرند", "شبستر", "آذرشهر", "اسکو", "جلفا", "کلیبر", "عجب‌شیر"],
    "آذربایجان غربی": ["ارومیه", "خوی", "مهاباد", "شوط", "پلدشت", "چالدران", "سلماس", "تکاب"],
    "کردستان": ["سنندج", "قروه", "بیجار", "کامیاران", "دیواندره", "سقز", "مریوان", "بانه"],
    "کرمان": ["کرمان", "رفسنجان", "سیرجان", "کوهبنان", "زرند", "بم", "بردسیر", "جیرفت"],
    "مرکزی": ["اراک", "ساوه", "کمیجان", "تفرش", "محلات", "خمین", "دلیجان", "زرندیه"],
    "گیلان": ["رشت", "صومعه‌سرا", "لاهیجان", "لنگرود", "انزلی", "آستانه اشرفیه", "فومن", "رودبار"],
    "مازندران": ["ساری", "آمل", "بابلسر", "چالوس", "نور", "بهشهر", "نکا", "تنکابن"],
    "قزوین": ["قزوین", "البرز", "بوئین‌زهرا", "آبیک"],
    "لرستان": ["خرم‌آباد", "بروجرد", "الیگودرز", "دورود", "ازنا", "پلدختر", "نورآباد"],
    "کهگیلویه و بویراحمد": ["یاسوج", "گچساران", "دنا", "بویراحمد", "دهدشت"],
    "بوشهر": ["بوشهر", "دشتستان", "گناوه", "دشتی", "کنگان", "جم", "تنگستان"],
    "همدان": ["همدان", "ملایر", "کبودرآهنگ", "بهار", "نهاوند", "رزن", "تویسرکان"],
    "سمنان": ["سمنان", "شاهرود", "دامغان", "گرمسار", "مهدیشهر", "آرادان"],
    "یزد": ["یزد", "میبد", "اردکان", "اشکذر", "تفت", "بافق", "ابرکوه", "خاتم"],
    "خراسان شمالی": ["بجنورد", "اسفراین", "شیروان", "آشخانه", "جاجرم", "گرمه", "مانه و سملقان"],
    "کرمانشاه": ["کرمانشاه", "اسلام‌آباد غرب", "صحنه", "کنگاور", "بیستون", "هرسین", "سرپل ذهاب", "قصرشیرین"],
    "گلستان": ["گرگان", "علی‌آباد کتول", "آق‌قلا", "کردکوی", "گنبد کاووس", "مینی‌سیم"],
    "خوزستان": ["اهواز", "دزفول", "آبادان", "خرمشهر", "مسجدسلیمان", "شوش"]
};

/* ==========================
   Main Elements & Navigation
   ========================== */
const formContainers = Array.from(document.querySelectorAll('.formContainer'));
const allSteps = document.querySelectorAll(".step");
const allProgressBars = document.querySelectorAll('.vertical-progress-bar-fill');
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const provinceSelect = document.getElementById('province');
const citySelect = document.getElementById('city');

let currentStep = 1;
const totalSteps = 4;

/* ==========================
   Helper Functions
   ========================== */

// Fill provinces dropdown
function populateProvinces() {
    provinceSelect.innerHTML = '<option value="" disabled selected>انتخاب استان</option>';
    Object.keys(provincesAndCities).forEach(p => {
        const op = document.createElement('option');
        op.value = p;
        op.textContent = p;
        provinceSelect.appendChild(op);
    });
}

// Fill cities based on selected province
function populateCities(province) {
    citySelect.innerHTML = '<option value="" disabled selected>انتخاب شهر</option>';
    (provincesAndCities[province] || []).forEach(c => {
        const op = document.createElement('option');
        op.value = c;
        op.textContent = c;
        citySelect.appendChild(op);
    });
    citySelect.disabled = !(provincesAndCities[province] && provincesAndCities[province].length);
}

/* ==========================
   Error Handling UI
   ========================== */
function showError(name, msg) {
    const errorEl = document.querySelector('.error[data-for="' + name + '"]');
    if (errorEl) {
        errorEl.textContent = msg;
        errorEl.classList.add("showError");
        const inputEl = document.getElementById(name);
        if (inputEl) inputEl.classList.add('borderError');
    }
}
function clearError(name) {
    const errorEl = document.querySelector('.error[data-for="' + name + '"]');
    if (errorEl) {
        errorEl.textContent = '';
        errorEl.classList.remove("showError");
        const inputEl = document.getElementById(name);
        if (inputEl) inputEl.classList.remove('borderError');
    }
}

/* ==========================
   Validation Rules
   ========================== */
function validateEmail(val){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val); }
function validateMobile(val){ return /^09\d{9}$/.test(val); }
function validatePostal(val){ return /^\d{10}$/.test(val); }

/* ==========================
   Step Validation Handler
   ========================== */
function validateStep(stepIndex) {
    const currentForm = document.getElementById(`form-step-${stepIndex}`);
    if (!currentForm) return true;

    let valid = true;
    const inputs = Array.from(currentForm.querySelectorAll('input, select'));

    inputs.forEach(i => {
        const name = i.id || i.name;
        clearError(name);

        const isRequired = i.hasAttribute('required');

        if (isRequired && !i.value.trim()) {
            showError(name, 'این فیلد الزامی است.');
            valid = false;
            return;
        }

        if (name === 'email' && i.value.trim() && !validateEmail(i.value.trim())) {
            showError(name, 'ایمیل معتبر نیست.');
            valid = false;
            return;
        }

        if (name === 'pwd' && i.value.length < 8) {
            showError(name, 'رمز باید حداقل ۸ کاراکتر باشد.');
            valid = false;
            return;
        }

        if (name === 'cpwd' && i.value !== document.getElementById('pwd').value) {
            showError(name, 'رمز و تکرار آن مطابقت ندارد.');
            valid = false;
            return;
        }

        if (name === 'phon' && !validateMobile(i.value)) {
            showError(name, 'شماره تماس معتبر نیست.');
            valid = false;
            return;
        }

        if (name === 'postalCode' && !validatePostal(i.value)) {
            showError(name, 'کد پستی باید ۱۰ رقم باشد.');
            valid = false;
        }

    });

    return valid;
}

/* ==========================
   Step Navigation Logic
   ========================== */
function showStep(n) {
    currentStep = n;

    formContainers.forEach(form => {
        form.classList.toggle('active', Number(form.dataset.step) === n);
        form.classList.toggle('hide', Number(form.dataset.step) !== n);
    });

    allSteps.forEach((step, index) => {
        const stepNumber = parseInt(step.dataset.step);
        const progressBar = allProgressBars[index];

        step.classList.toggle('active', stepNumber <= n);
        progressBar.style.height = stepNumber <= n ? '100%' : '0';
    });

    prevBtn.classList.toggle("hideBtn", n === 1);

    if (n === totalSteps) {
        nextBtn.innerText = "تأیید و ثبت نهایی";
        document.querySelector(".btnWrapper").style.display = "none";
    } else {
        nextBtn.innerText = "مرحله بعدی";
        document.querySelector(".btnWrapper").style.display = "flex";
    }
}

/* ==========================
   Events
   ========================== */
nextBtn.addEventListener('click', () => {
    if (currentStep < totalSteps) {
        if (validateStep(currentStep)) showStep(currentStep + 1);
    } else {
        alert('فرم با موفقیت ارسال شد.');
    }
});

prevBtn.addEventListener('click', () => showStep(currentStep - 1));

provinceSelect.addEventListener('change', e => populateCities(e.target.value));

document.getElementById('restartBtn').addEventListener('click', () => {
    document.querySelectorAll('form').forEach(f => f.reset());
    populateProvinces();
    citySelect.disabled = true;
    showStep(1);
});

/* ==========================
   Initial Load
   ========================== */
populateProvinces();
showStep(1);
