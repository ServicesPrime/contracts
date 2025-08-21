{{-- C:\laragon\www\contracts\resources\views\contracts\styles.blade.php --}}

<style>
    /* Configuración de tamaño y márgenes de página para impresión */
    @page {
        size: letter;
        /* Tamaño carta estándar (8.5" x 11") */
        margin: 0.5in 0.5in 1in;
        /* Márgenes como en tu imagen */
    }

    /* Evitar que el contenido se corte entre páginas al imprimir */
    @media print {
        .page {
            break-after: page;
            page-break-after: always;
        }
    }

    /* Asegurar que ningún elemento se divida entre páginas */
    .page,
    .content,
    h1,
    h2,
    h3,
    h4,
    p,
    ul,
    ol,
    li,
    table,
    thead,
    tbody,
    tfoot,
    tr,
    td,
    th {
        break-inside: avoid-page;
        page-break-inside: avoid;
    }

    /* Configuración general */
    * {
        box-sizing: border-box;
    }

    html,
    body {
        padding: 0;
        margin: 0;
        overflow-x: hidden;
    }

    body {
        font-family: Arial, sans-serif;
        color: #000;
    }

    /* Cada página */
    .page {
        display: block;
        min-height: calc(11in - 0.5in - 1in);
        /* Altura Letter menos márgenes */
        padding: 15px 0 0 0;
        position: relative;
    }

    /* MÁRGENES IGUALES PARA TODAS LAS PÁGINAS */
    .content-with-padding {
        padding: 120px 120px 0 120px;
        /* Márgenes consistentes */
        max-width: 100%;
    }

    .content {
        text-align: left;
    }

    /* TÍTULOS CON TAMAÑOS CONSISTENTES */
    
    /* Título principal - 18pt */
    h1 {
        text-align: center;
        color: #b41f24;
        font-size: 18pt !important;
        font-weight: bold;
        line-height: 1.1;
        margin: 15px 0 20px 0;
        font-family: Arial, sans-serif;
    }

    /* Subtítulos - 13pt */
    h2 {
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 18px 0 15px 0;
        font-family: Arial, sans-serif;
    }

    h3 {
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 14px 0 6px 0;
        font-family: Arial, sans-serif;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA DE NOTICES */
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

    /* ESTILOS ESPECÍFICOS PARA PÁGINA MISCELLANEOUS */
    .miscellaneous-title {
        text-align: left;
        color: #b41f24 !important;
        font-size: 12pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA TERMS OF AGREEMENT */
    .terms-title {
        text-align: left;
        color: #b41f24 !important;
        font-size: 12pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    .signature-table {
        width: 100%;
        table-layout: fixed;
        color: #1c2969;
        font-size: 11pt !important;
        margin-top: 10px;
    }

    .signature-cell {
        width: 50%;
        vertical-align: top;
        padding: 5px 15px 15px 15px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .signature-cell strong {
        color: #b41f24 !important;
        font-weight: bold;
        font-size: 11pt !important;
        font-family: Arial, sans-serif;
    }

    .signature-line {
        border-bottom: 2px solid #b41f24;
        width: 90%;
        margin: 0 auto;
        height: 15px;
        font-size: 11pt !important;
    }

    .signature-label {
        text-align: center;
        font-size: 11pt !important;
        color: #1c2969;
        font-family: Arial, sans-serif;
        margin-top: 8px;
        margin-bottom: 80px;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA SERVICE AREAS */
    .service-areas-title {
        text-align: center;
        color: #b41f24;
        font-size: 16pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA OVERNIGHT KITCHEN CLEANING */
    .overnight-cleaning-title {
        text-align: center;
        color: #b41f24 !important;
        font-size: 15pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    .fees-title {
        text-align: center;
        color: #b41f24 !important;
        font-size: 15pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    .pricing-table {
        width: 90%;
        margin: 15px auto 0;
        border-collapse: collapse;
        table-layout: fixed;
        color: #1c2969;
        border: 1px solid #b41f24;
        font-size: 11pt !important;
        font-family: Arial, sans-serif;
    }

    .pricing-table th {
        border: 1px solid #b41f24;
        padding: 10px;
        text-align: center;
        background-color: #b41f24;
        color: white;
        font-weight: bold;
    }

    .pricing-table td {
        border: 1px solid #b41f24;
        padding: 10px;
        text-align: center;
        background-color: white;
        color: #1c2969;
    }

    .exhibit-title {
        text-align: center;
        color: #b41f24 !important;
        font-size: 15pt !important;
        font-weight: bold;
        margin: 30px 0 15px 0;
        font-family: Arial, sans-serif;
    }

    .exhibit-signature-table {
        width: 100%;
        table-layout: fixed;
        color: #1c2969;
        font-size: 11pt !important;
        margin-top: 20px;
    }

    .exhibit-signature-cell {
        width: 50%;
        vertical-align: top;
        padding: 15px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .exhibit-signature-cell strong {
        color: #b41f24 !important;
        font-weight: bold;
        font-size: 11pt !important;
        font-family: Arial, sans-serif;
    }

    .exhibit-signature-line {
        border-bottom: 2px solid #b41f24;
        width: 90%;
        margin: 0 auto;
        height: 15px;
        font-size: 11pt !important;
    }

    .exhibit-signature-label {
        text-align: center;
        font-size: 11pt !important;
        color: #1c2969;
        font-family: Arial, sans-serif;
        margin-top: 8px;
        margin-bottom: 80px;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA EXHIBIT B */
    .exhibit-b-title {
        text-align: center;
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 15px 0 10px 0;
        font-family: Arial, sans-serif;
    }

    .benefits-waiver-title {
        text-align: center;
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 0 0 20px 0;
        font-family: Arial, sans-serif;
    }

    .exhibit-b-signature-table {
        width: 100%;
        table-layout: fixed;
        color: #1c2969;
        font-size: 11pt !important;
        margin-top: 20px;
    }

    .exhibit-b-signature-cell {
        width: 50%;
        vertical-align: top;
        padding: 15px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .exhibit-b-signature-line {
        border-bottom: 2px solid #b41f24;
        width: 90%;
        margin: 0 auto;
        height: 15px;
        font-size: 11pt !important;
    }

    .exhibit-b-signature-label {
        text-align: center;
        font-size: 11pt !important;
        color: #1c2969;
        font-family: Arial, sans-serif;
        margin-top: 8px;
        margin-bottom: 80px;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA EXHIBIT C */
    .exhibit-c-title {
        text-align: center;
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 15px 0 10px 0;
        font-family: Arial, sans-serif;
    }

    .confidentiality-title {
        text-align: center;
        color: #b41f24;
        font-size: 13pt !important;
        font-weight: bold;
        margin: 0 0 20px 0;
        font-family: Arial, sans-serif;
    }

    .exhibit-c-signature-table {
        width: 100%;
        table-layout: fixed;
        color: #1c2969;
        font-size: 11pt !important;
        margin-top: 20px;
    }

    .exhibit-c-signature-cell {
        width: 50%;
        vertical-align: top;
        padding: 15px;
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .exhibit-c-signature-line {
        border-bottom: 2px solid #b41f24;
        width: 90%;
        margin: 0 auto;
        height: 15px;
        font-size: 11pt !important;
    }

    .exhibit-c-signature-label {
        text-align: center;
        font-size: 11pt !important;
        color: #1c2969;
        font-family: Arial, sans-serif;
        margin-top: 8px;
        margin-bottom: 80px;
    }

    /* ESTILOS ESPECÍFICOS PARA PÁGINA OPTIONAL PROVISIONS */
    .optional-provisions-title {
        text-align: center;
        color: #b41f24;
        font-size: 16pt !important;
        font-weight: bold;
        margin: 15px 0 25px 0;
        font-family: Arial, sans-serif;
    }

    /* TEXTO DEL CUERPO - 11pt CON INTERLINEADO MEJORADO */
    p {
        font-size: 11pt !important;
        line-height: 1.5;
        /* Interlineado normal */
        text-align: justify;
        margin: 0 0 15px 0;
        color: #1c2969;
        font-family: Arial, sans-serif;
    }

    /* Elementos numerados principales */
    .numbered-item {
        font-size: 11pt !important;
        font-weight: normal;
        color: #1c2969;
        margin: 0 0 15px 0;
        font-family: Arial, sans-serif;
        line-height: 1.5;
        text-align: justify;
    }

    /* Sub-elementos de listas */
    .sub-list {
        margin-left: 25px;
        /* Indentación consistente */
        margin-bottom: 14px;
    }

    .sub-item {
        font-size: 11pt !important;
        line-height: 1.5;
        /* Interlineado mejorado y consistente */
        text-align: justify;
        margin: 0 0 8px 0;
        color: #1c2969;
        font-family: Arial, sans-serif;
        font-weight: normal;
    }

    /* Listas ordenadas y no ordenadas (por si las usas) */
    ol,
    ul {
        padding-left: 20px;
        margin: 6px 0 10px;
    }

    li {
        font-size: 11pt !important;
        line-height: 1.5;
        /* Interlineado consistente */
        margin: 0 0 6px;
        color: #1c2969;
        text-align: justify;
        font-family: Arial, sans-serif;
    }

    /* Footer fijo - AJUSTADO PARA IMPRESIÓN */
    .footer {
        position: fixed;
        bottom: 15px; /* Cambiado de 0 a 15px para subirlo */
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .footer-red {
        background-color: #b41f24;
        height: 8px; /* Reducido de 10px a 8px para ser más compacto */
        width: 100%;
    }

    .footer-blue {
        background-color: #162469ff;
        padding: 12px 35px; /* Reducido de 15px a 12px */
        text-align: center;
        color: #fff;
        font-size: 10pt; /* Reducido de 11pt a 10pt */
        font-weight: normal;
        width: 100%;
        line-height: 1.2; /* Reducido de 1.3 a 1.2 */
        font-family: Arial, sans-serif;
    }

    .site-footer {
        width: 100%;
    }

    /* Ajustes para que el contenido no se superponga con el footer */
    .page:not(.cover) {
        padding-bottom: 75px; /* Reducido de 90px a 75px */
    }

    /* Estilos específicos para la portada */
    .page.cover {
        padding-bottom: 0;
    }

    .page.cover .footer-cover {
        position: absolute;
        bottom: 20px;
        left: 0;
        right: 0;
        text-align: center;
        color: #b41f24;
        font-weight: bold;
        font-size: 22px;
        line-height: 1.4;
        z-index: 1001;
    }

    /* NUMERACIÓN DE PÁGINAS - TAMBIÉN AJUSTADA */
    .page-number {
        position: fixed;
        bottom: 95px; /* Ajustado de 110px a 95px */
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

    /* Asegurar que la numeración esté por encima del footer */
    .page:not(.cover) .page-number {
        display: block;
    }
    h3.titulo-centro {
   text-align: center !important;
}
h2 {
        text-decoration: underline;
    }

</style>