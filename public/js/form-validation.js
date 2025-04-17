/**
 * Form validation for donation box creation
 * Validates payment methods and required fields
 */

function validateDonationForm() {
    // Get form elements
    const campaignTitle = document.getElementById('campaign_title_field')?.value?.trim();
    const payeeName = document.querySelector('input[name="payee"]')?.value?.trim();
    const detail = document.querySelector('input[name="detail"]')?.value?.trim();
    const iban = document.querySelector('input[name="iban"]')?.value?.trim();
    
    // Get payment method elements
    const sebEnabled = document.querySelector('input[name="seb"]')?.checked;
    const sebUid = document.querySelector('input[name="sebuid"]')?.value?.trim();
    const sebUidSt = document.querySelector('input[name="sebuid_st"]')?.value?.trim();
    
    // Get internet-bank methods
    const swedEnabled = document.querySelector('input[name="swed"]')?.checked;
    const lhvEnabled = document.querySelector('input[name="lhv"]')?.checked;
    const coopEnabled = document.querySelector('input[name="coop"]')?.checked;
    
    // Get credit card methods
    const stripeEnabled = document.querySelector('input[name="stripe"]')?.checked;
    const stripeValue = document.querySelector('input[name="strp"]')?.value?.trim();
    const paypalEnabled = document.querySelector('input[name="paypal"]')?.checked;
    const paypalValue = document.querySelector('input[name="pp"]')?.value?.trim();
    const paypalHostedEnabled = document.querySelector('input[name="paypal_hosted"]')?.checked;
    const paypalHostedValue = document.querySelector('input[name="pphb"]')?.value?.trim();
    const donorboxEnabled = document.querySelector('input[name="donorbox"]')?.checked;
    const donorboxValue = document.querySelector('input[name="db"]')?.value?.trim();
    const revolutEnabled = document.querySelector('input[name="revolut"]')?.checked;
    const revolutValue = document.querySelector('input[name="rev"]')?.value?.trim();
    
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
            message: "Campaign title is required",
            step: steps.campaignDetails
        });
    }
    
    if (!detail) {
        errors.push({
            message: "Bank transfer detail is required",
            step: steps.campaignDetails
        });
    }
    
    if (!payeeName) {
        errors.push({
            message: "Payee's name is required",
            step: steps.personalData
        });
    }
    
    // Validate internet-bank methods
    const internetBankEnabled = swedEnabled || lhvEnabled || coopEnabled || sebEnabled;
    if (internetBankEnabled && !iban) {
        errors.push({
            message: "IBAN is required when any internet-bank payment method is enabled",
            step: steps.bankDetails
        });
    }
    
    // Validate SEB method
    if (sebEnabled && (!sebUid || !sebUidSt)) {
        errors.push({
            message: "Both SEB UID tokens are required when SEB payment method is enabled",
            step: steps.bankDetails
        });
    }
    
    // Validate credit card methods
    if (stripeEnabled && !stripeValue) {
        errors.push({
            message: "Stripe payment link ID is required when Stripe payment method is enabled",
            step: steps.creditCardDetails
        });
    }
    
    if (paypalEnabled && !paypalValue) {
        errors.push({
            message: "PayPal email is required when PayPal payment method is enabled",
            step: steps.creditCardDetails
        });
    }
    
    if (paypalHostedEnabled && !paypalHostedValue) {
        errors.push({
            message: "PayPal hosted button ID is required when PayPal hosted button payment method is enabled",
            step: steps.creditCardDetails
        });
    }
    
    if (donorboxEnabled && !donorboxValue) {
        errors.push({
            message: "Donorbox campaign name is required when Donorbox payment method is enabled",
            step: steps.creditCardDetails
        });
    }
    
    if (revolutEnabled && !revolutValue) {
        errors.push({
            message: "Revolut username is required when Revolut payment method is enabled",
            step: steps.creditCardDetails
        });
    }
    
    return errors;
}

/**
 * Display validation errors to the user
 * @param {Array} errors - Array of error objects with message and step properties
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
        errorsByStep[error.step].push(error.message);
    });
    
    // Create error message
    let errorMessage = "Please fix the following errors:\n\n";
    
    // Add step information to error message
    Object.keys(errorsByStep).forEach(step => {
        const stepName = getStepName(parseInt(step));
        errorMessage += `Step ${step} (${stepName}):\n`;
        errorsByStep[step].forEach(message => {
            errorMessage += `- ${message}\n`;
        });
        errorMessage += "\n";
    });
    
    // Show error message
    alert(errorMessage);
    
    // Navigate to the first step with errors
    const firstErrorStep = Math.min(...Object.keys(errorsByStep).map(Number));
    if (app && typeof app.step !== 'undefined') {
        app.step = firstErrorStep;
    }
    
    return false;
}

/**
 * Get step name based on step number
 * @param {Number} step - Step number
 * @returns {String} - Step name
 */
function getStepName(step) {
    switch (step) {
        case 1:
            return "Campaign Details";
        case 2:
            return "Personal Data";
        case 3:
            return "Bank Details";
        case 4:
            return "Credit Card Details";
        default:
            return "Unknown Step";
    }
}