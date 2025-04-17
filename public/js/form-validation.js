/**
 * Form validation for donation box creation
 * Validates payment methods and required fields
 */

function validateDonationForm() {
    // Get form elements
    const campaignTitle = document.getElementById('campaign_title_field')?.value?.trim();
    const payeeName = document.querySelector('input[name="payee"]')?.value?.trim();
    const detail = document.querySelector('input[name="detail"]')?.value?.trim();
    
    // Clear previous error messages
    clearValidationErrors();
    
    // Validation errors
    const errors = [];
    
    // Step tracking for error messages
    const steps = {
        campaignDetails: 1,
        personalData: 2,
        bankDetails: 3,
        creditCardDetails: 4
    };
    
    // Validate required fields
    if (!campaignTitle) {
        errors.push({
            message: "validation.campaign_title_required",
            field: 'campaign_title_field',
            step: steps.campaignDetails
        });
    }
    
    if (!detail) {
        errors.push({
            message: "validation.bank_transfer_detail_required",
            field: 'detail',
            step: steps.campaignDetails
        });
    }
    
    if (!payeeName) {
        errors.push({
            message: "validation.payee_name_required",
            field: 'payee',
            step: steps.personalData
        });
    }
    
    // Get payment method validation errors
    const paymentMethodErrors = validatePaymentMethods();
    
    // Combine all errors
    return [...errors, ...paymentMethodErrors];
}

/**
 * Clear all validation error messages
 */
function clearValidationErrors() {
    // Remove all error messages
    document.querySelectorAll('.validation-error').forEach(el => el.remove());
    
    // Remove error classes from input fields
    document.querySelectorAll('.error-border').forEach(el => {
        el.classList.remove('error-border');
    });
}

/**
 * Display validation errors to the user
 * @param {Array} errors - Array of error objects with message, field and step properties
 * @param {Object} app - Alpine.js app instance
 */
function displayValidationErrors(errors, app) {
    if (errors.length === 0) {
        return true;
    }
    
    // Group errors by step
    const errorsByStep = {};
    errors.forEach(error => {
        if (!errorsByStep[error.step]) {
            errorsByStep[error.step] = [];
        }
        errorsByStep[error.step].push(error);
    });
    
    // Display errors in the UI
    errors.forEach(error => {
        const field = document.querySelector(`[name="${error.field}"]`) || 
                     document.getElementById(error.field);
        
        if (field) {
            // Add error class to the field
            field.classList.add('error-border');
            
            // Create error message element
            const errorElement = document.createElement('div');
            errorElement.className = 'validation-error text-red-500 text-xs mt-1';
            errorElement.textContent = translateErrorMessage(error.message);
            
            // Insert error message after the field
            field.parentNode.insertBefore(errorElement, field.nextSibling);
        }
    });
    
    // Create summary error message at the top of the current step
    const currentStep = app.step;
    if (errorsByStep[currentStep] && errorsByStep[currentStep].length > 0) {
        const stepContainer = document.querySelector(`[x-show="step === ${currentStep}"]`);
        if (stepContainer) {
            const summaryElement = document.createElement('div');
            summaryElement.className = 'validation-error bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
            
            const summaryTitle = document.createElement('strong');
            summaryTitle.className = 'font-bold';
            summaryTitle.textContent = translateErrorMessage('validation.please_fix_errors');
            
            const summaryList = document.createElement('ul');
            summaryList.className = 'mt-2 list-disc list-inside';
            
            errorsByStep[currentStep].forEach(error => {
                const listItem = document.createElement('li');
                listItem.textContent = translateErrorMessage(error.message);
                summaryList.appendChild(listItem);
            });
            
            summaryElement.appendChild(summaryTitle);
            summaryElement.appendChild(summaryList);
            
            // Insert at the beginning of the step container
            stepContainer.insertBefore(summaryElement, stepContainer.firstChild);
        }
    }
    
    // Navigate to the first step with errors
    const firstErrorStep = Math.min(...Object.keys(errorsByStep).map(Number));
    if (app && typeof app.step !== 'undefined') {
        app.step = firstErrorStep;
    }
    
    return false;
}

/**
 * Translate error message based on the current locale
 * @param {String} key - Translation key
 * @returns {String} - Translated message
 */
function translateErrorMessage(key) {
    // Get current locale
    const locale = document.documentElement.lang || 'en';
    
    // Translation object
    const translations = {
        'en': {
            'validation.please_fix_errors': 'Please fix the following errors:',
            'validation.campaign_title_required': 'Campaign title is required',
            'validation.bank_transfer_detail_required': 'Bank transfer detail is required',
            'validation.payee_name_required': 'Payee\'s name is required',
            'validation.iban_required': 'IBAN is required when any internet-bank payment method is enabled',
            'validation.seb_uid_required': 'SEB UID token is required when SEB payment method is enabled',
            'validation.seb_uid_st_required': 'SEB UID ST token is required when SEB payment method is enabled',
            'validation.stripe_id_required': 'Stripe payment link ID is required when Stripe payment method is enabled',
            'validation.paypal_email_required': 'PayPal email is required when PayPal payment method is enabled',
            'validation.paypal_hosted_id_required': 'PayPal hosted button ID is required when PayPal hosted button payment method is enabled',
            'validation.donorbox_name_required': 'Donorbox campaign name is required when Donorbox payment method is enabled',
            'validation.revolut_username_required': 'Revolut username is required when Revolut payment method is enabled',
            'validation.sebuid_required': 'SEB UID token is required when SEB payment method is enabled',
            'validation.sebuid_st_required': 'SEB UID ST token is required when SEB payment method is enabled',
            'validation.strp_required': 'Stripe payment link ID is required when Stripe payment method is enabled',
            'validation.pp_required': 'PayPal email is required when PayPal payment method is enabled',
            'validation.pphb_required': 'PayPal hosted button ID is required when PayPal hosted button payment method is enabled',
            'validation.db_required': 'Donorbox campaign name is required when Donorbox payment method is enabled',
            'validation.rev_required': 'Revolut username is required when Revolut payment method is enabled'
        },
        'ee': {
            'validation.please_fix_errors': 'Palun parandage järgmised vead:',
            'validation.campaign_title_required': 'Kampaania pealkiri on kohustuslik',
            'validation.bank_transfer_detail_required': 'Pangaülekande selgitus on kohustuslik',
            'validation.payee_name_required': 'Makse saaja nimi on kohustuslik',
            'validation.iban_required': 'IBAN on kohustuslik, kui mõni internetipanga makseviis on lubatud',
            'validation.seb_uid_required': 'SEB UID token on kohustuslik, kui SEB makseviis on lubatud',
            'validation.seb_uid_st_required': 'SEB UID ST token on kohustuslik, kui SEB makseviis on lubatud',
            'validation.stripe_id_required': 'Stripe makse lingi ID on kohustuslik, kui Stripe makseviis on lubatud',
            'validation.paypal_email_required': 'PayPal e-post on kohustuslik, kui PayPal makseviis on lubatud',
            'validation.paypal_hosted_id_required': 'PayPal hostitud nupu ID on kohustuslik, kui PayPal hostitud nupu makseviis on lubatud',
            'validation.donorbox_name_required': 'Donorbox kampaania nimi on kohustuslik, kui Donorbox makseviis on lubatud',
            'validation.revolut_username_required': 'Revolut kasutajanimi on kohustuslik, kui Revolut makseviis on lubatud',
            'validation.sebuid_required': 'SEB UID token on kohustuslik, kui SEB makseviis on lubatud',
            'validation.sebuid_st_required': 'SEB UID ST token on kohustuslik, kui SEB makseviis on lubatud',
            'validation.strp_required': 'Stripe makse lingi ID on kohustuslik, kui Stripe makseviis on lubatud',
            'validation.pp_required': 'PayPal e-post on kohustuslik, kui PayPal makseviis on lubatud',
            'validation.pphb_required': 'PayPal hostitud nupu ID on kohustuslik, kui PayPal hostitud nupu makseviis on lubatud',
            'validation.db_required': 'Donorbox kampaania nimi on kohustuslik, kui Donorbox makseviis on lubatud',
            'validation.rev_required': 'Revolut kasutajanimi on kohustuslik, kui Revolut makseviis on lubatud'
        },
        'lv': {
            'validation.please_fix_errors': 'Lūdzu, izlabojiet šādas kļūdas:',
            'validation.campaign_title_required': 'Kampaņas nosaukums ir obligāts',
            'validation.bank_transfer_detail_required': 'Bankas pārskaitījuma informācija ir obligāta',
            'validation.payee_name_required': 'Saņēmēja vārds ir obligāts',
            'validation.iban_required': 'IBAN ir obligāts, ja ir iespējota kāda internetbankas maksājumu metode',
            'validation.seb_uid_required': 'SEB UID tokens ir obligāts, ja ir iespējota SEB maksājumu metode',
            'validation.seb_uid_st_required': 'SEB UID ST tokens ir obligāts, ja ir iespējota SEB maksājumu metode',
            'validation.stripe_id_required': 'Stripe maksājuma saites ID ir obligāts, ja ir iespējota Stripe maksājumu metode',
            'validation.paypal_email_required': 'PayPal e-pasts ir obligāts, ja ir iespējota PayPal maksājumu metode',
            'validation.paypal_hosted_id_required': 'PayPal viesotās pogas ID ir obligāts, ja ir iespējota PayPal viesotās pogas maksājumu metode',
            'validation.donorbox_name_required': 'Donorbox kampaņas nosaukums ir obligāts, ja ir iespējota Donorbox maksājumu metode',
            'validation.revolut_username_required': 'Revolut lietotājvārds ir obligāts, ja ir iespējota Revolut maksājumu metode',
            'validation.sebuid_required': 'SEB UID tokens ir obligāts, ja ir iespējota SEB maksājumu metode',
            'validation.sebuid_st_required': 'SEB UID ST tokens ir obligāts, ja ir iespējota SEB maksājumu metode',
            'validation.strp_required': 'Stripe maksājuma saites ID ir obligāts, ja ir iespējota Stripe maksājumu metode',
            'validation.pp_required': 'PayPal e-pasts ir obligāts, ja ir iespējota PayPal maksājumu metode',
            'validation.pphb_required': 'PayPal viesotās pogas ID ir obligāts, ja ir iespējota PayPal viesotās pogas maksājumu metode',
            'validation.db_required': 'Donorbox kampaņas nosaukums ir obligāts, ja ir iespējota Donorbox maksājumu metode',
            'validation.rev_required': 'Revolut lietotājvārds ir obligāts, ja ir iespējota Revolut maksājumu metode'
        },
        'lt': {
            'validation.please_fix_errors': 'Prašome ištaisyti šias klaidas:',
            'validation.campaign_title_required': 'Kampanijos pavadinimas yra privalomas',
            'validation.bank_transfer_detail_required': 'Banko pervedimo informacija yra privaloma',
            'validation.payee_name_required': 'Gavėjo vardas yra privalomas',
            'validation.iban_required': 'IBAN yra privalomas, kai įjungtas bet kuris internetinės bankininkystės mokėjimo būdas',
            'validation.seb_uid_required': 'SEB UID žetonas yra privalomas, kai įjungtas SEB mokėjimo būdas',
            'validation.seb_uid_st_required': 'SEB UID ST žetonas yra privalomas, kai įjungtas SEB mokėjimo būdas',
            'validation.stripe_id_required': 'Stripe mokėjimo nuorodos ID yra privalomas, kai įjungtas Stripe mokėjimo būdas',
            'validation.paypal_email_required': 'PayPal el. paštas yra privalomas, kai įjungtas PayPal mokėjimo būdas',
            'validation.paypal_hosted_id_required': 'PayPal talpinamo mygtuko ID yra privalomas, kai įjungtas PayPal talpinamo mygtuko mokėjimo būdas',
            'validation.donorbox_name_required': 'Donorbox kampanijos pavadinimas yra privalomas, kai įjungtas Donorbox mokėjimo būdas',
            'validation.revolut_username_required': 'Revolut vartotojo vardas yra privalomas, kai įjungtas Revolut mokėjimo būdas',
            'validation.sebuid_required': 'SEB UID žetonas yra privalomas, kai įjungtas SEB mokėjimo būdas',
            'validation.sebuid_st_required': 'SEB UID ST žetonas yra privalomas, kai įjungtas SEB mokėjimo būdas',
            'validation.strp_required': 'Stripe mokėjimo nuorodos ID yra privalomas, kai įjungtas Stripe mokėjimo būdas',
            'validation.pp_required': 'PayPal el. paštas yra privalomas, kai įjungtas PayPal mokėjimo būdas',
            'validation.pphb_required': 'PayPal talpinamo mygtuko ID yra privalomas, kai įjungtas PayPal talpinamo mygtuko mokėjimo būdas',
            'validation.db_required': 'Donorbox kampanijos pavadinimas yra privalomas, kai įjungtas Donorbox mokėjimo būdas',
            'validation.rev_required': 'Revolut vartotojo vardas yra privalomas, kai įjungtas Revolut mokėjimo būdas'
        },
        'ru': {
            'validation.please_fix_errors': 'Пожалуйста, исправьте следующие ошибки:',
            'validation.campaign_title_required': 'Название кампании обязательно',
            'validation.bank_transfer_detail_required': 'Информация о банковском переводе обязательна',
            'validation.payee_name_required': 'Имя получателя обязательно',
            'validation.iban_required': 'IBAN обязателен, если включен любой способ оплаты через интернет-банк',
            'validation.seb_uid_required': 'Токен SEB UID обязателен, если включен способ оплаты SEB',
            'validation.seb_uid_st_required': 'Токен SEB UID ST обязателен, если включен способ оплаты SEB',
            'validation.stripe_id_required': 'ID ссылки на оплату Stripe обязателен, если включен способ оплаты Stripe',
            'validation.paypal_email_required': 'Электронная почта PayPal обязательна, если включен способ оплаты PayPal',
            'validation.paypal_hosted_id_required': 'ID размещенной кнопки PayPal обязателен, если включен способ оплаты размещенной кнопки PayPal',
            'validation.donorbox_name_required': 'Название кампании Donorbox обязательно, если включен способ оплаты Donorbox',
            'validation.revolut_username_required': 'Имя пользователя Revolut обязательно, если включен способ оплаты Revolut',
            'validation.sebuid_required': 'Токен SEB UID обязателен, если включен способ оплаты SEB',
            'validation.sebuid_st_required': 'Токен SEB UID ST обязателен, если включен способ оплаты SEB',
            'validation.strp_required': 'ID ссылки на оплату Stripe обязателен, если включен способ оплаты Stripe',
            'validation.pp_required': 'Электронная почта PayPal обязательна, если включен способ оплаты PayPal',
            'validation.pphb_required': 'ID размещенной кнопки PayPal обязателен, если включен способ оплаты размещенной кнопки PayPal',
            'validation.db_required': 'Название кампании Donorbox обязательно, если включен способ оплаты Donorbox',
            'validation.rev_required': 'Имя пользователя Revolut обязательно, если включен способ оплаты Revolut'
        }
    };
    
    // Return translated message or fallback to English or key itself
    return (translations[locale] && translations[locale][key]) || 
           translations['en'][key] || 
           key;
}

/**
 * Get step name based on step number
 * @param {Number} step - Step number
 * @returns {String} - Step name
 */
function getStepName(step) {
    // Get current locale
    const locale = document.documentElement.lang || 'en';
    
    // Step names by locale
    const stepNames = {
        'en': {
            1: "Campaign Details",
            2: "Personal Data",
            3: "Bank Details",
            4: "Credit Card Details"
        },
        'ee': {
            1: "Kampaania info",
            2: "Isikuandmed",
            3: "Pangaandmed",
            4: "Krediitkaardi andmed"
        },
        'lv': {
            1: "Kampaņas informācija",
            2: "Personīgie dati",
            3: "Bankas informācija",
            4: "Kredītkartes informācija"
        },
        'lt': {
            1: "Kampanijos informacija",
            2: "Asmeniniai duomenys",
            3: "Banko informacija",
            4: "Kredito kortelės informacija"
        },
        'ru': {
            1: "Информация о кампании",
            2: "Личные данные",
            3: "Банковская информация",
            4: "Информация о кредитной карте"
        }
    };
    
    // Return step name based on locale or fallback to English
    return (stepNames[locale] && stepNames[locale][step]) || 
           stepNames['en'][step] || 
           "Unknown Step";
}

/**
 * Check if IBAN is required based on selected payment methods
 * @returns {boolean} True if IBAN is required
 */
function isIbanRequired() {
    // Check for internet-bank methods that require IBAN
    const swedEnabled = document.getElementById('swt')?.checked || false;
    const sebEnabled = document.getElementById('sebt')?.checked || false;
    const lhvEnabled = document.getElementById('lhvt')?.checked || false;
    const coopEnabled = document.getElementById('coopt')?.checked || false;
    
    return swedEnabled || sebEnabled || lhvEnabled || coopEnabled;
}

/**
 * Set IBAN field as required if any internet-bank method is enabled
 */
function updateIbanRequiredStatus() {
    const ibanField = document.querySelector('input[name="iban"]');
    if (!ibanField) return;
    
    if (isIbanRequired()) {
        // Set IBAN as required
        ibanField.setAttribute('required', 'required');
        ibanField.dataset.requiredMessage = translateErrorMessage('validation.iban_required');
        ibanField.dataset.requiredStep = 3;
    } else {
        // Remove required attribute
        ibanField.removeAttribute('required');
        delete ibanField.dataset.requiredMessage;
        delete ibanField.dataset.requiredStep;
    }
}

/**
 * Validate donation form based on payment methods
 * This function is called when the form is submitted
 * @returns {Array} Array of validation errors
 */
function validatePaymentMethods() {
    const errors = [];
    
    // Update IBAN required status
    updateIbanRequiredStatus();
    
    // Validate internet-bank methods (IBAN required)
    // Check for internet-bank methods that require IBAN
    const swedEnabled = document.getElementById('swt')?.checked || false;
    const sebEnabled = document.getElementById('sebt')?.checked || false;
    const lhvEnabled = document.getElementById('lhvt')?.checked || false;
    const coopEnabled = document.getElementById('coopt')?.checked || false;
    
    if (swedEnabled || sebEnabled || lhvEnabled || coopEnabled) {
        const ibanField = document.querySelector('input[name="iban"]');
        if (ibanField && (!ibanField.value || ibanField.value.trim() === '')) {
            errors.push({
                field: 'iban',
                message: translateErrorMessage('validation.iban_required'),
                step: 3
            });
        }
    }
    
    // Validate SEB method (at least one UID token required)
    if (sebEnabled) {
        const sebuid = document.querySelector('input[name="sebuid"]');
        const sebuid_st = document.querySelector('input[name="sebuid_st"]');
        
        // Check if both UID tokens are missing
        if ((!sebuid || !sebuid.value.trim()) && (!sebuid_st || !sebuid_st.value.trim())) {
            errors.push({
                field: 'sebuid',
                message: translateErrorMessage('validation.seb_uid_required'),
                step: 3
            });
        }
    }
    
    // Validate credit card methods
    // Map of credit card method IDs to their corresponding field names
    const creditCardMethods = [
        { id: 'strptoggle', field: 'strp', message: 'validation.stripe_id_required' },
        { id: 'pptoggle', field: 'pp', message: 'validation.paypal_email_required' },
        { id: 'pphbtoggle', field: 'pphb', message: 'validation.paypal_hosted_id_required' },
        { id: 'dbtoggle', field: 'db', message: 'validation.donorbox_name_required' },
        { id: 'revtoggle', field: 'rev', message: 'validation.revolut_username_required' }
    ];
    
    creditCardMethods.forEach(method => {
        const methodEnabled = document.getElementById(method.id)?.checked || false;
        if (methodEnabled) {
            const fieldElement = document.querySelector(`input[name="${method.field}"]`);
            if (fieldElement && (!fieldElement.value || fieldElement.value.trim() === '')) {
                errors.push({
                    field: method.field,
                    message: translateErrorMessage(method.message),
                    step: 4
                });
            }
        }
    });
    
    return errors;
}

/**
 * Initialize validation event listeners
 * This function is called when the DOM is loaded
 */
function initValidationListeners() {
    // Add required attribute to essential fields
    const essentialFields = [
        { name: 'campaign_title_field', step: 1 },
        { name: 'detail', step: 1 },
        { name: 'payee', step: 2 }
    ];
    
    // Set required attribute for essential fields
    essentialFields.forEach(field => {
        const element = document.getElementById(field.name) || document.querySelector(`input[name="${field.name}"]`);
        if (element) {
            element.setAttribute('required', 'required');
            element.dataset.requiredMessage = translateErrorMessage(`validation.${field.name}_required`);
            element.dataset.requiredStep = field.step;
        }
    });
    
    // Add event listeners to payment method checkboxes
    const paymentMethods = [
        { name: 'seb', fields: ['sebuid', 'sebuid_st'], step: 3 },
        { name: 'stripe', fields: ['strp'], step: 4 },
        { name: 'paypal', fields: ['pp'], step: 4 },
        { name: 'paypal_hosted', fields: ['pphb'], step: 4 },
        { name: 'donorbox', fields: ['db'], step: 4 },
        { name: 'revolut', fields: ['rev'], step: 4 }
    ];
    
    // Add event listeners to all payment method checkboxes
    paymentMethods.forEach(method => {
        const checkbox = document.querySelector(`input[name="${method.name}"]`);
        if (checkbox) {
            // Define the change handler function
            const handleChange = function() {
                method.fields.forEach(field => {
                    const fieldElement = document.querySelector(`input[name="${field}"]`);
                    if (fieldElement) {
                        if (this.checked) {
                            // If checkbox is checked, add required attribute
                            fieldElement.setAttribute('required', 'required');
                            
                            // Add data attributes for error messages
                            fieldElement.dataset.requiredMessage = translateErrorMessage(`validation.${field}_required`);
                            fieldElement.dataset.requiredStep = method.step;
                        } else {
                            // If checkbox is unchecked, remove required attribute
                            fieldElement.removeAttribute('required');
                            delete fieldElement.dataset.requiredMessage;
                            delete fieldElement.dataset.requiredStep;
                        }
                    }
                });
            };
            
            // Add the event listener
            checkbox.addEventListener('change', handleChange);
            
            // Immediately apply the required attributes based on current state
            if (checkbox.checked) {
                method.fields.forEach(field => {
                    const fieldElement = document.querySelector(`input[name="${field}"]`);
                    if (fieldElement) {
                        fieldElement.setAttribute('required', 'required');
                        fieldElement.dataset.requiredMessage = translateErrorMessage(`validation.${field}_required`);
                        fieldElement.dataset.requiredStep = method.step;
                    }
                });
            }
        }
    });
    
    // Handle internet-bank checkboxes and IBAN field
    const internetBanks = ['swed', 'lhv', 'coop', 'seb'];
    
    // Set initial IBAN required status
    updateIbanRequiredStatus();
    
    // Add event listeners to internet-bank checkboxes
    internetBanks.forEach(bank => {
        const checkbox = document.querySelector(`input[name="${bank}"]`);
        if (checkbox) {
            checkbox.addEventListener('change', function() {
                // Update IBAN required status whenever a bank checkbox changes
                updateIbanRequiredStatus();
            });
        }
    });
    
    // Add a special event listener to the IBAN field to validate it on blur
    const ibanField = document.querySelector('input[name="iban"]');
    if (ibanField) {
        ibanField.addEventListener('blur', function() {
            // If IBAN is required but empty, show error
            if (isIbanRequired() && !this.value.trim()) {
                this.classList.add('error-border');
                
                // Remove any existing error message
                const existingError = this.parentNode.querySelector('.validation-error');
                if (existingError) {
                    existingError.remove();
                }
                
                // Add error message
                const errorElement = document.createElement('div');
                errorElement.className = 'validation-error text-red-500 text-xs mt-1';
                errorElement.textContent = translateErrorMessage('validation.iban_required');
                this.parentNode.insertBefore(errorElement, this.nextSibling);
            } else {
                // Remove error styling if field is valid
                this.classList.remove('error-border');
                
                // Remove any existing error message
                const existingError = this.parentNode.querySelector('.validation-error');
                if (existingError) {
                    existingError.remove();
                }
            }
        });
    }
}

/**
 * Validate SEB UID tokens
 * This function is called when the SEB checkbox is toggled or when the UID fields lose focus
 * @returns {boolean} True if validation passes
 */
function validateSebUids() {
    const sebEnabled = document.getElementById('sebt')?.checked || false;
    if (!sebEnabled) return true;

    const sebuid = document.querySelector('input[name="sebuid"]');
    const sebuid_st = document.querySelector('input[name="sebuid_st"]');
    const errorMsg = document.getElementById('seb-uid-error');

    if (!sebuid || !sebuid_st || !errorMsg) return true;

    if (!sebuid.value && !sebuid_st.value) {
        errorMsg.classList.remove('hidden');
        sebuid.classList.add('border-red-500');
        sebuid_st.classList.add('border-red-500');
        return false;
    } else {
        errorMsg.classList.add('hidden');
        sebuid.classList.remove('border-red-500');
        sebuid_st.classList.remove('border-red-500');
        return true;
    }
}

// Initialize validation listeners when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initValidationListeners();
    
    // Run initial validation for all enabled payment methods
    const paymentMethodToggles = [
        'swt', 'sebt', 'lhvt', 'coopt', 'strptoggle', 'pptoggle', 'pphbtoggle', 'dbtoggle', 'revtoggle'
    ];
    
    // Check which toggles are enabled by default and trigger validation
    paymentMethodToggles.forEach(toggleId => {
        const toggle = document.getElementById(toggleId);
        if (toggle && toggle.checked) {
            // Update IBAN required status for bank methods
            updateIbanRequiredStatus();
            
            // Validate SEB UIDs if SEB is enabled
            if (toggleId === 'sebt') {
                validateSebUids();
            }
        }
    });
});