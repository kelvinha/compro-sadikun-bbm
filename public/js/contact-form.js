/**
 * Contact Form JavaScript
 * Handles client-side validation and user experience for contact forms
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize contact forms
    initContactForms();
});

function initContactForms() {
    const contactForm = document.getElementById('contactForm');
    const homeContactForm = document.getElementById('homeContactForm');
    
    if (contactForm) {
        setupFormValidation(contactForm, 'submitBtn');
    }
    
    if (homeContactForm) {
        setupFormValidation(homeContactForm, 'homeSubmitBtn');
    }
}

function setupFormValidation(form, submitBtnId) {
    const submitBtn = document.getElementById(submitBtnId);
    
    // Add real-time validation
    const inputs = form.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateField(this);
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (validateForm(form)) {
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            // Submit the form
            this.submit();
        }
    });
}

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Remove existing validation classes
    field.classList.remove('is-valid', 'is-invalid');
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = `${getFieldLabel(fieldName)} is required.`;
    }
    
    // Email validation
    if (fieldName === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid email address.';
        }
    }
    
    // Phone validation (optional but if provided should be valid)
    if (fieldName === 'phone' && value) {
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number.';
        }
    }
    
    // CAPTCHA validation
    if (fieldName === 'captcha' && value) {
        if (!/^\d+$/.test(value)) {
            isValid = false;
            errorMessage = 'Please enter a valid number.';
        }
    }
    
    // Apply validation styling
    if (isValid) {
        field.classList.add('is-valid');
    } else {
        field.classList.add('is-invalid');
    }
    
    // Show error message
    const feedbackElement = field.parentNode.querySelector('.invalid-feedback');
    if (feedbackElement) {
        feedbackElement.textContent = errorMessage;
    }
    
    return isValid;
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let isFormValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isFormValid = false;
        }
    });
    
    // Scroll to first error if any
    if (!isFormValid) {
        const firstError = form.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    }
    
    return isFormValid;
}

function getFieldLabel(fieldName) {
    const labels = {
        'name': 'Name',
        'email': 'Email',
        'phone': 'Phone',
        'subject': 'Subject',
        'message': 'Message',
        'captcha': 'Security Question'
    };
    
    return labels[fieldName] || fieldName.charAt(0).toUpperCase() + fieldName.slice(1);
}

// Auto-dismiss alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 500);
            }
        }, 5000);
    });
});
