{{-- resources/views/contracts/styles.blade.php --}}

<style>

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

    /* Ajustes para que el contenido no se superponga con el footer en páginas normales */
    .page:not(.cover) {
        padding-bottom: 90px;
    }

    /* ==========================================
       COMPONENTE: FOOTER COVER (Portada)
    ========================================== */
    /* =========================
   FOOTER COVER (descarga por defecto)
========================= */
.footer-cover {
    position: static;  /* default para PDF */
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

/* =========================
   FOOTER GENERAL (descarga por defecto)
========================= */
.footer {
    /* position: fixed;  default para PDF */

    position: static;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}

/* =========================
   OVERRIDE SOLO PARA PREVIEW
========================= */
.preview-mode .footer-cover,
.preview-mode .footer {
    position: static !important;
    bottom: auto !important;
    left: auto !important;
    right: auto !important;
}


    .footer-red {
        background-color: #9a1b2a;
        height: 10px;
        width: 100%;
    }
    .footer-redt {
        background-color: #b91f32;
        padding: 15px 50px;
        text-align: center;
        color: #fff;
        font-size: 11pt;
        font-weight: normal;
        width: 100%;
        line-height: 1.3;
        font-family: Arial, sans-serif;
    }

    .footer-blue {
        background-color: #162469ff;
        padding: 15px 35px;
        text-align: center;
        color: #fff;
        font-size: 11pt;
        font-weight: normal;
        width: 100%;
        line-height: 1.3;
        font-family: Arial, sans-serif;
    }

    .site-footer {
        width: 100%;
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
       CLASES UTILITARIAS (Reutilizables)
    ========================================== */



    .content-padding {
    padding: 75px 30px 0 30px;
    max-width: 100%;
}

/* ===== Preview (cuando isPreview llega) ===== */
.preview-mode .content-padding {
    padding: 60px 10px 0 10px !important;
    max-width: 100% !important;
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
       CLASES DE TEXTO (Reutilizables)
    ========================================== */
    .titulo {
        color: #b41f24;
        font-size: 20pt;
        font-family: Arial, sans-serif;
        font-weight: bold;
        text-align: center;
    }

    .subtitulo {
        color: #b41f24;
        font-size: 14pt;
        font-family: Arial, sans-serif;
        font-weight: bold;
        text-align: left;
        text-decoration: underline;
    }
        .subtitulo-sin {
        color: #b41f24;
        font-size: 14pt;
        font-family: Arial, sans-serif;
        font-weight: bold;
        text-align: left;
       
    }

    .texto-normal {
        font-size: 11pt;
        font-family: Arial, sans-serif;
        line-height: 1.5;
        color: #1c2969;
    }

    .script-title {
        font-family: 'Script MT Bold', cursive;
        font-weight: bold;
        color: #b41f24;
        font-size: 11pt;
        line-height: 1.5;
    }

    /* ==========================================
       NUMERACIÓN DE PÁGINAS
    ========================================== */
    .page-number {
        position: static;
        bottom: 110px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1002;
        color: #1c2969;
        font-size: 10pt;
        font-family: Arial, sans-serif;
        font-weight: normal;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 2px 5px;
        border-radius: 3px;
        text-align: center;
    }

    /* Ocultar numeración en la portada */
    .page.cover .page-number {
        display: none;
    }

    /* Mostrar numeración en páginas normales */
    .page:not(.cover) .page-number {
        display: block;
    }

    /* ==========================================
       ESTILOS ESPECÍFICOS PARA PÁGINA DE NOTICES
    ========================================== */
    .notices-title {
        text-align: center;
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    .notices-intro {
        text-align: center;
        max-width: 75%;
        margin: 0 auto 20px auto;
        font-size: 11pt !important;
        line-height: 1.5;
        color: #1c2969;
        font-family: Arial, sans-serif;
    }

    .notice-section {
        position: relative;
        max-width: 90%;
        margin: 15px auto;
        line-height: 1.5;
        text-align: center;
    }

    .notice-label {
        position: absolute;
        left: 25%;
        top: 0;
        color: #b41f24;
        font-weight: bold;
        font-size: 11pt !important;
        font-family: Arial, sans-serif;
        white-space: nowrap;
        transform: translateX(-100%);
        margin-right: 10px;
    }

    .notice-content {
        color: #1c2969;
        text-align: left;
        font-size: 11pt !important;
        line-height: 1.5;
        font-family: Arial, sans-serif;
        display: inline-block;
        margin: 0 auto;
    }
</style>