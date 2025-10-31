{include file="headerv2.tpl"}
    <div class="container">
        <div class="error-page">
            <div class="error-container">
                <div class="error-icon">
                    <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="60" cy="60" r="55" stroke="#e74c3c" stroke-width="4" fill="#ffe6e6"/>
                        <path d="M60 30 L60 70" stroke="#e74c3c" stroke-width="6" stroke-linecap="round"/>
                        <circle cx="60" cy="85" r="4" fill="#e74c3c"/>
                    </svg>
                </div>
                
                <h1 class="error-title">
                        Oops! Something went wrong
                </h1>
                
                <div class="error-message">
                    {if $error_message}
                        <p>{$error_message}</p>
                    {else}
                        <p>We encountered an unexpected error while processing your request. Please try again later.</p>
                    {/if}
                </div>

                <div class="error-actions">
                    <a href="javascript:history.back()" class="btn btn-secondary">
                        <i class="icon-back"></i> Go Back
                    </a>
                    <a href="/federation/dashboard" class="btn btn-primary">
                        <i class="icon-home"></i> Go to Dashboard
                    </a>
                </div>
                
                <div class="error-help">
                    <p>If this problem persists, please contact support at <a href="mailto:support@aaccu.coop">support@aaccu.coop</a></p>
                </div>
            </div>
        </div>
    </div>

<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .error-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .error-container {
        text-align: center;
        background: white;
        padding: 50px 40px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        width: 100%;
    }
    
    .error-icon {
        margin-bottom: 30px;
        animation: shake 0.5s ease-in-out;
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }
    
    .error-title {
        color: #e74c3c;
        font-size: 28px;
        margin: 0 0 20px 0;
        font-weight: bold;
    }
    
    .error-message {
        color: #2c3e50;
        font-size: 16px;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    
    .error-message p {
        margin: 10px 0;
    }
    
    .error-code {
        background-color: #f8f9fa;
        border-left: 4px solid #e74c3c;
        padding: 15px;
        margin-bottom: 20px;
        text-align: left;
        font-family: monospace;
        color: #7f8c8d;
    }
    
    .error-details {
        margin-bottom: 30px;
        text-align: left;
    }
    
    .error-details details {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 15px;
    }
    
    .error-details summary {
        cursor: pointer;
        font-weight: bold;
        color: #7f8c8d;
        user-select: none;
    }
    
    .error-details summary:hover {
        color: #2c3e50;
    }
    
    .error-details pre {
        margin-top: 15px;
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 15px;
        border-radius: 5px;
        overflow-x: auto;
        font-size: 12px;
        line-height: 1.4;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
    
    .error-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 30px;
    }
    
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        font-size: 14px;
    }
    
    .btn-primary {
        background-color: #3498db;
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
    }
    
    .btn-secondary {
        background-color: #95a5a6;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #7f8c8d;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(149, 165, 166, 0.3);
    }
    
    .btn-success {
        background-color: #27ae60;
        color: white;
    }
    
    .btn-success:hover {
        background-color: #229954;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(39, 174, 96, 0.3);
    }
    
    .error-help {
        padding-top: 20px;
        border-top: 1px solid #ecf0f1;
        color: #7f8c8d;
        font-size: 14px;
    }
    
    .error-help a {
        color: #3498db;
        text-decoration: none;
        font-weight: bold;
    }
    
    .error-help a:hover {
        text-decoration: underline;
    }
    
    /* Icon placeholders */
    .icon-back::before { content: "← "; }
    .icon-home::before { content: "🏠 "; }
    .icon-retry::before { content: "🔄 "; }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .error-container {
            padding: 30px 20px;
        }
        
        .error-title {
            font-size: 24px;
        }
        
        .error-message {
            font-size: 14px;
        }
        
        .error-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .error-icon svg {
            width: 80px;
            height: 80px;
        }
    }
    
    /* Print styles */
    @media print {
        .error-actions,
        .error-help {
            display: none;
        }
    }
</style>

{include file="footerv2.tpl"}
