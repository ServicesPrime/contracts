{{-- resources/views/contracts/styles.blade.php --}}

<style>
    /* ==========================================
       CONFIGURACIÓN BASE DE PÁGINA
    ========================================== */
    @page {
        size: letter;
        margin: 0.5in 0.5in 1in;
    }

    @media print {
        .page {
            break-after: page;
            page-break-after: always;
        }
    }

    * {
        box-sizing: border-box;
    }

    html, body {
        padding: 0;
        margin: 0;
        overflow-x: hidden;
    }

    body {
        font-family: Arial, sans-serif;
        color: #000;
    }

    /* ==========================================
       LAYOUT BÁSICO DE PÁGINA
    ========================================== */
    .page {
        display: block;
        min-height: calc(11in - 0.5in - 1in);
        padding: 15px 0 0 0;
        position: relative;
    }

    .page.cover {
        padding-bottom: 0;
    }

    /* ==========================================
       COMPONENTE: FOOTER COVER (Reutilizable)
    ========================================== */
    .footer-cover {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
        color: #b41f24;
        font-weight: bold;
        font-size: 24px;
        line-height: 1.5;
        z-index: 1001;
        font-family: Arial, sans-serif;
    }

    /* ==========================================
       CLASES UTILITARIAS (Reutilizables)
    ========================================== */
    .content-padding {
        padding: 120px 120px 0 120px;
        max-width: 100%;
    }

    .text-center { 
        text-align: center; 
    }

    .text-red { 
        color: #b41f24; 
    }

    .font-bold { 
        font-weight: bold; 
    }

    .p-30 { 
        padding: 0 30px; 
    }

    .mt-20 { 
        margin-top: 20px; 
    }

    .mt-150 { 
        margin-top: 150px; 
    }

    .mb-30 { 
        margin-bottom: 30px; 
    }

    .margin-y-20 { 
        margin: 20px 0; 
    }

    /* ==========================================
       CLASE TITULO (Nueva)
    ========================================== */
    .titulo {
        color: #b41f24;
        font-size: 20pt;
        font-family: Arial, sans-serif;
        font-weight: bold;
        text-align: center;
    }

    /* ==========================================
       COMPONENTE: WATERMARK (Reutilizable)
    ========================================== */
    .watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1;
        opacity: 0.05;
        pointer-events: none;
    }

    .watermark-image {
        width: 1200px;
        height: auto;
    }

    /* ==========================================
       CLASE TEXTO NORMAL (Nueva)
    ========================================== */
    .texto-normal {
        font-size: 11pt;
        font-family: Arial, sans-serif;
        line-height: 1.5;
        color: #1c2969;
    }

    /* ==========================================
       CLASE SCRIPT TITLE (Nueva)
    ========================================== */
    .script-title {
        font-family: 'Script MT Bold', cursive;
        font-weight: bold;
        color: #b41f24;
        font-size: 11pt;
        line-height: 1.5;
    }
</style>