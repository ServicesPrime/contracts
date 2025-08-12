<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Contract Document</title>
  <style>
    /* Configuración de tamaño y márgenes de página para impresión */
    @page {
      size: A4;
      /* Puedes cambiar a 'letter' si lo necesitas */
      margin: 25mm 20mm 35mm;
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
    }

    body {
      font-family: Arial, sans-serif;
      color: #000;
    }

    /* Cada página */
    .page {
      display: block;
      min-height: calc(297mm - 25mm - 35mm);
      /* Altura A4 menos márgenes */
      padding: 20px 30px 0 30px;
    }

    .content {
      text-align: left;
    }

    /* Título principal */
    /* Jerarquía clara de títulos */
    h1 {
      text-align: center;
      color: #b41f24;
      font-size: 40px !important;
      /* súbelo para que domine */
      font-weight: 800;
      /* más peso que bold */
      line-height: 1.2;
      margin: 0 0 20px;
    }

    h2 {
      color: #b41f24;
      font-size: 30px !important;
      /* más chico que h1 */
      font-weight: 700;
      margin: 24px 0 8px;
    }

    h3 {
      color: #991f23;
      font-size: 22px !important;
      font-weight: 700;
      margin: 20px 0 6px;
    }

    /* Baja un poco el cuerpo del texto para que no compita con los títulos */
    p,
    li {
      font-size: 18px;
      /* antes 21px */
      line-height: 1.6;
      text-align: left;
      margin: 0 0 10px;
      color: #1c2969;


    }


    /* Texto general */
    p,
    li {
      font-size: 25px;
      line-height: 1.6;
      text-align: left;
      margin: 0 0 10px;
    }

    ol {
      padding-left: 22px;
      margin: 6px 0 12px;
    }

    /* Footer */
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .footer-red {
      background-color: #b41f24;
      height: 12px;
      /* más alto */
      width: 100%;
    }

    .footer-blue {
      background-color: #162469ff;
      padding: 25px 42px;
      /* más alto */
      text-align: center;
      color: #fff;
      font-size: 25px;
      /* más grande */
      font-weight: bold;
      width: 100%;
      line-height: 1.4;
    }

    .site-footer {
      width: 100%;
    }
  </style>
</head>

<body>
@php
  // Rutas absolutas a las imágenes en tu máquina
  $logoPath = 'C:\laragon\www\contracts\storage\app\public\Primee.png';
  $bldgPath = 'C:\laragon\www\contracts\storage\app\public\Edificio.png';

  // Convertir a base64 si existen
  $logo64 = file_exists($logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath)) : '';
  $bldg64 = file_exists($bldgPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($bldgPath)) : '';
@endphp

<!-- ====== PORTADA / NUEVA PRIMERA PÁGINA ====== -->
<div class="page cover" style="position:relative; min-height:100vh;">
  <div class="content" style="text-align:center; padding:0 20px;">

    <!-- Logo PRIME (más grande) -->
    @if($logo64)
      <img src="{{ $logo64 }}" alt="Prime Logo" style="width:500px; height:auto; margin-top:20px;">
    @endif

    <!-- Título + Eslogan -->
    <div style="padding-top:40px;">
      <h1 style="color:#1c2969; text-align:center; font-size:60px; line-height:1.2; margin:0;">
        Facility Services Group
      </h1>
      <p style="color:#b41f24; font-size:45px; text-align:center; margin:10px 0 30px;">
        “The Best Services In The Industry Or Nothing At All”
      </p>
    </div>

    <!-- Imagen Edificio (más alta) -->
    @if($bldg64)
      <img src="{{ $bldg64 }}" alt="Edificio" style="width:100%; height:500px; object-fit:cover; margin-top:20px;">
    @endif
  </div>

  <!-- Footer especial solo para la portada (3 líneas y más grande) -->
  <div class="footer-cover" style="
    position:absolute; left:0; right:0; bottom:20px;
    text-align:center; color:#b41f24; font-weight:bold;
    font-size:24px; line-height:1.5;">
<div>8303 Westglen Dr - Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065</div>
<div>www.primefacilityservicesgroup.com</div>
  </div>
</div>
<!-- ====== FIN PORTADA ====== -->


  <!-- Página 1 -->
  <div class="page">
    <div class="content">
      <h1>GENERAL TEMPORARY SERVICES AGREEMENT</h1>

      <p>
        PRIME FACILITY SERVICES GROUP, with its principal office located at 8303 Westglen Dr, TX 77063 (“PRIME”), and "{{ $contract->client->address->name_account }}", with its principal office located at "{{ $contract->client->address->full_address }}" ("CLIENT") agree to the terms and conditions outlined in this Staffing Agreement (the "Agreement").
      </p>

      <h2>Prime Facility Services Group (Prime) Duties and Responsibilities</h2>
      <ol>
        <li>Prime will:
          <ol type="a">
            <li>Deliver the facility management services described in Exhibit A at the locations specified, ensuring that all tasks are completed to the highest standards and in accordance with industry best practices.</li>
            <li>Pay Prime Associates’ wages and provide them with the benefits Prime offers them.</li>
            <li>Provide unemployment insurance and workers’ compensation benefits and handle unemployment and workers’ compensation claims involving Prime Associates.</li>
            <li>Require Prime Associates to sign confidentiality agreements (in the form of Exhibit C) before they begin their assignments to CLIENT.</li>
          </ol>
        </li>
      </ol>

      <h2>CLIENT’s Duties and Responsibilities</h2>
      <ol>
        <li>Client will:
          <ol type="a" start="5">
            <li>Properly manage and supervise the delivery of services, ensuring that all operations, products, and procedures meet the agreed-upon standards.</li>
            <li>Properly supervise, control, and safeguard its premises, processes, and systems, or entrust them with unattended premises, cash, credit cards, merchandise, confidential or trade secret information, keys, negotiable instruments, or other valuables without PRIME’s express prior written approval or strictly required by the job description provided to PRIME.</li>
            <li>Provide Prime Associates with a safe work site and appropriate information, training, and safety equipment concerning any hazardous substances or conditions that may be exposed at the work site.</li>
            <li>Not change Prime Associates’ job duties without PRIME’s express prior written approval.</li>
            <li>Provide access to the facility and any necessary site-specific information or resources required for the proper execution of the services described in Exhibit A.</li>
            <li>Exclude Prime Associates from CLIENT’s benefit plans, policies, and practices, and do not make any offer or promise relating to Prime.</li>
          </ol>
        </li>
      </ol>
    </div>
  </div>

  <!-- Página 2 -->
  <div class="page">
    <div class="content" style="margin-top: 60px;">
      <h2>Payment Terms, Bill Rates, and Fees</h2>

      <ol start="2">
        <li>
          Client will pay PRIME for the services delivered as outlined in Exhibit A, at the rates specified. PRIME will invoice CLIENT on a periodic basis (weekly, monthly, or as otherwise agreed) based on the completion of the tasks specified in the Scope of Work.
          <p>Payment is due within 15 to 30 days from the date of the invoice. Invoices will be supported by the pertinent time sheets or other agreed systems for documenting time worked by the Prime Associates. CLIENT’s signature or other agreed method of approval of the work time submitted for Prime Associates certifies that the documented hours are correct. It authorizes PRIME to bill CLIENT for those hours. If a portion of any invoice is disputed, the CLIENT will pay the undisputed portion.</p>
        </li>

        <li>Prime Associates are presumed to be nonexempt from laws requiring premium pay for overtime, holiday work, or weekend work. PRIME will charge CLIENT special rates for premium work time only when a Prime Associate’s work on assignment to CLIENT, viewed by itself, would legally require premium pay and CLIENT has authorized, directed, or allowed the Prime Associate to work such premium work time. CLIENT’s special billing rate for premium hours will be billed the exact multiple of the regular billing rate as PRIME is required to apply to the Prime Associate’s standard pay rate. (For example, when federal law requires time ½ of pay for work exceeding 40 hours a week, CLIENT will be billed at time ½ plus the regular billing rate markup.)</li>

        <li>In addition to the bill rates specified in Exhibit A of this agreement, CLIENT will pay PRIME the amount of all new or increased labor costs associated with CLIENT’s Prime Associates that PRIME is legally required to pay—such as wages, benefits, payroll taxes, social program contributions, or charges linked to benefit levels—until the parties agree on new bill rates.</li>

        <li>The Customer acknowledges and agrees that Prime Hospitality Services of Texas shall charge applicable state taxes on all goods and services provided under this contract. The rate of state taxes and the method of calculation shall be in accordance with the prevailing state tax laws and regulations. The Customer shall be responsible for paying these state taxes and the agreed-upon fees for the contracted services. Prime Hospitality Services of Texas shall provide the Customer with proper documentation and receipts for state tax charges. Any changes to state tax rates or regulations shall be applied to the orders accordingly.</li>
      </ol>
    </div>
  </div>

  <!-- Página 3 -->
  <div class="page">
    <div class="content" style="margin-top: 60px;">
      <h2>Confidential Information</h2>
      <p>Neither party shall disclose proprietary or confidential information received from the other party, including but not limited to, methods, procedures, or any sensitive information related to the services provided. Both parties agree to hold such information in strict confidence and not to disclose such information to third parties or to use such information for any purpose whatsoever other than performing under this Agreement or as required by law. No knowledge, possession, or use of CLIENT’s confidential information will be imputed to PRIME due to Prime Associates’ access to such information.</p>

      <h2>Entire Agreement</h2>
      <p>This Agreement and the attached Exhibits constitute the entire agreement between the parties concerning the subject matter and supersede all previous verbal or written agreements. Any modification of this Agreement must be in writing and signed by a duly authorized party representative. There are no other understandings, obligations, representations, or warranties relating to the subject matter of this Agreement except as herein expressed. This Agreement shall supersede and shall not be modified or amended in any way by the printed terms of any invoice.</p>

      <h2>Waiver</h2>
      <p>The failure of any party to insist upon strict performance of any of the terms, conditions, and provisions of this Agreement shall not be deemed a waiver of future compliance in addition to that by the party by which the same is required to be performed hereunder. It shall in no way prejudice the remaining provisions of this Agreement. All remedies reserved to CLIENT shall be cumulative and in addition to any other or future remedies provided by law or equity.</p>

      <h2>Severability</h2>
      <p>If any provision of this Agreement or the application of any such provision to any person or in any circumstance is held invalid, the application of such provision to any other person or in any other circumstance, and the remainder of this Agreement, shall not be affected thereby and shall remain in full effect.</p>

      <h2>Cooperation</h2>
      <p>The parties agree to cooperate fully and assist the other party in investigating and resolving any complaints, scams, frauds, actions, or proceedings that may be brought by or that may involve Prime Associates.</p>
    </div>
  </div>

  <!-- Página 4 -->
  <div class="page">
    <div class="content" style="margin-top: 60px;">
      <h2>Indemnification and Limitation of Liability</h2>
      <ol>
        <li>To the extent permitted by law, PRIME will defend, indemnify, and hold CLIENT harmless from all claims, losses, and liabilities arising directly from PRIME’s execution of the services described in this Agreement, including any damages caused by negligence or failure to meet agreed-upon standards.</li>
        <li>To the extent permitted by the law, CLIENT will defend, indemnify, and hold PRIME and its parent, subsidiaries, directors, officers, agents, representatives, and employees harmless from all claims, losses, and liabilities (including reasonable attorneys’ fees) to the extent caused by CLIENT’s breach of this agreement; its failure to discharge its duties and responsibilities outlined in paragraph 2; or the negligence, gross negligence, or willful misconduct of CLIENT or CLIENT’s officers, employees, or authorized agents in the discharge of those duties and responsibilities.</li>
        <li>Neither party shall be liable for or be required to indemnify the other party for any incidental, consequential, exemplary, special, punitive, or lost profit damages that arise in connection with this Agreement, regardless of the form of action (whether in contract, tort, negligence, strict liability, or otherwise) and regardless of how characterized, even if such a party has been advised of the possibility of such damages.</li>
        <li>As a condition precedent to indemnification, the party seeking indemnification will perform the other party within (2) business days after it received notice of any claim, liability, or demand for which it seeks indemnification from the other party, and the party seeking indemnification will cooperate in the investigation and defense of any such matter.</li>
        <li>The provisions of this agreement constitute the complete agreement between the parties concerning indemnification, and each party waives the right to assert any common-law indemnification or contribution claim against the other party.</li>
      </ol>
    </div>
  </div>

  <!-- Footer fijo global -->
  <div class="footer">
    <div class="site-footer">
      <div class="footer-red"></div>
      <div class="footer-blue">
        8303 Westglen Dr ~ Houston, TX 77063 ~ Phone 713-338-2553 ~ Fax 713-574-3065<br>
        www.primefacilityservicesgroup.com
      </div>
    </div>
  </div>

</body>

</html>
<!-- PÁGINA 5 - Notices -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:20px; color:#b41f24;">NOTICES</h2>

    <p style="text-align:center; max-width:75%; margin:auto; line-height:1.6;">
      All notices required under this Agreement shall be in writing, and if to the
      <strong>CLIENT</strong> shall be sufficient in all respects if delivered in person or sent by a nationally recognized overnight courier service or by registered or certified mail to:
    </p>

    <div style="display:flex; justify-content:center; max-width:70%; margin:20px auto; line-height:1.6;">
      <div style="flex:0 0 auto; padding-right:10px; color:#b41f24; font-weight:bold; text-align:center;">
        Client:
      </div>
      <div style="color:#1c2969; text-align:center;">
        Executive Chef {{ $contract->client->name}}<br>
        {{ $contract->client->address->name_account }}<br>
        {{ $contract->client->address->street }}<br>
        {{ $contract->client->address->city }}, {{ $contract->client->address->state }}, {{ $contract->client->address->zip_code }}

      </div>
    </div>

    <div style="display:flex; justify-content:center; max-width:70%; margin:10px auto; line-height:1.6;">
      <div style="flex:0 0 auto; padding-right:10px; color:#b41f24; font-weight:bold; text-align:center;">
        Attn:
      </div>
      <div style="color:#1c2969; text-align:center;">
        <p style="text-align: center;">
          {{ $contract->client->phone }}
        </p>
        <p style="text-align: center;">
          {{ $contract->client->email }}
        </p>

      </div>
    </div>

    <p style="text-align:left; max-width:80%; margin:auto; line-height:1.6; margin-top:20px;">
      Moreover, if to <strong>Contractor</strong> shall be sufficient in all respects if delivered in person or sent by a nationally recognized overnight courier service or by registered or certified mail to:
    </p>

    <div style="display:flex; justify-content:center; max-width:70%; margin:20px auto; line-height:1.6;">
      <div style="flex:0 0 auto; padding-right:10px; color:#b41f24; font-weight:bold; text-align:center;">
        Temporary Service Provider:
      </div>
      <div style="color:#1c2969; text-align:center;">
        Prime Facility Services Group<br>
        8303 Westglen Dr<br>
        Houston, Texas 77063
      </div>
    </div>

    <div style="display:flex; justify-content:center; max-width:70%; margin:10px auto; line-height:1.6;">
      <div style="flex:0 0 auto; padding-right:10px; color:#b41f24; font-weight:bold; text-align:center;">
        Attn:
      </div>
      <div style="color:#1c2969; text-align:center;">
        Patty Perez – President<br>
        Or<br>
        Rafael S. Perez Jr. – Sr. Vice President
      </div>
    </div>
  </div>
</div>

<!-- PÁGINA 6 - Miscellaneous -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:20px;">MISCELLANEOUS</h2>

    <ol>
      <li>Provisions of this Agreement, which by their terms extend beyond the termination or nonrenewal of this Agreement, will remain effective after termination or nonrenewal.</li>
      <li>No provision of this Agreement may be amended or waived unless agreed to in writing signed by both parties.</li>
      <li>Each provision of this Agreement will be considered severable. If any provision or clause conflicts with existing or future applicable law or may not be given full effect because of such law, no other provision that can operate without the conflicting provision or clause will be affected.</li>
      <li>This Agreement and the exhibits attached to it contain the entire understanding between the parties and supersede all prior agreements and understanding relating to the subject matter of the Agreement.</li>
      <li>The provisions of this Agreement will inure to the benefit of and be binding on the parties and their respective representatives, successors, and assigns.</li>
      <li>The failure of a party to enforce the provisions of this Agreement will not be a waiver of any provisions or the right of such party after that to enforce each provision of this Agreement.</li>
      <li>CLIENT will not transfer or assign this Agreement without PRIME’s written consent.</li>
      <li>Any notice or other communication will be deemed adequately given only when sent via the United States Postal Service or a nationally recognized courier, addressed as shown on the first page of this Agreement.</li>
      <li>Neither party will be responsible for failure or delay in the performance of this Agreement if the failure or delay is due to labor disputes, strikes, fire, riot, war, terrorism, acts of God, or any other causes beyond the control of the nonperforming party.</li>
    </ol>
  </div>
</div>

<!-- PÁGINA 7 - Terms of Agreement -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:20px;">TERMS OF AGREEMENT</h2>

    <p>
      Terms of Agreement will be for 1 year from the first date both parties have executed it.
      The Agreement may be terminated by either party upon 30 days written notice.
      This clause applies to all services described in the Agreement, except if a party becomes bankrupt or insolvent,
      discontinues operations, or fails to make payments as required; either party may terminate the agreement upon 24 hours written notice.
    </p>

    <p>
      Upon the expiration of the original term or any renewal term of employment, Employee's work shall be automatically renewed yearly unless,
      at least thirty (30) written notice days before the renewal date, either party gives the other party written notice of its intent not to continue the employment relationship.
      During any renewal term of employment, the terms, conditions, and provisions outlined in this Agreement shall remain in effect unless modified.
    </p>

    <p>
      Authorized parties' representatives have executed this Agreement below to express the parties’ agreement to its terms.
    </p>

    <br><br>

    <table style="width:100%; font-size:20px; table-layout:fixed; color:#1c2969;">
      <tr>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>{{ $contract->client->address->name_account }}</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">

            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>Prime Facility Services Group</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>

<!-- PÁGINA 8 - Service Areas & Scope of Work -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:20px;">SERVICE AREAS & SCOPE OF WORK</h2>

    <h3>Service Areas:</h3>
    <ul>
      <li>Main Kitchen</li>
    </ul>

    <h3>Scope of Work</h3>
    <p><strong>Frequency:</strong> Monthly, 7 days per week</p>

    <ul>
      <li>Thorough cleaning of all kitchen surfaces, ensuring removal of grease, food residues, and buildup in hard-to-reach areas.</li>
    </ul>

    <h3>Equipment:</h3>
    <ul>
      <li>Clean all kitchen appliances and equipment (exterior surfaces, control panels, and access areas).</li>
      <li>Remove accumulated grease and debris from behind and underneath appliances where accessible.</li>
    </ul>

    <h3>Floors:</h3>
    <ul>
      <li>Sweep and mop all floor surfaces.</li>
      <li>Apply an intensive degreasing treatment to remove stubborn residues.</li>
    </ul>

    <h3>Walls & Ceilings:</h3>
    <ul>
      <li>Wipe down and degrease walls and ceilings in food preparation and cooking areas.</li>
      <li>Remove stains and dust to maintain a clean and sanitary environment.</li>
    </ul>
  </div>
</div>

<!-- PÁGINA 9 - Overnight Kitchen Cleaning / Exhibit A -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:20px;">OVERNIGHT KITCHEN CLEANING</h2>

    <p><strong>Fees, Plus Taxes</strong></p>

    <table style="width:90%; margin:15px auto 0; border-collapse:collapse; table-layout:fixed; color:#1c2969; border:1px solid #1c2969;">
      <thead>
        <tr>
          <th style="border:1px solid #1c2969; padding:10px; text-align:center;">Description</th>
          <th style="border:1px solid #1c2969; padding:10px; text-align:center;">Frequency</th>
          <th style="border:1px solid #1c2969; padding:10px; text-align:center;">Bill Rate (Monthly)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="border:1px solid #1c2969; padding:10px; text-align:center;">Kitchen Cleaning 7 days per week (Main Kitchen)</td>
          <td style="border:1px solid #1c2969; padding:10px; text-align:center;">Monthly</td>
          <td style="border:1px solid #1c2969; padding:10px; text-align:center;">$6,089.56</td>
        </tr>
      </tbody>
    </table>


    <h3 style="text-align:center; margin-top:30px;">EXHIBIT A</h3>

    <table style="width:100%; font-size:20px; table-layout:fixed; color:#1c2969;">
      <tr>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>{{ $contract->client->address->name_account }}</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">

            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>Prime Facility Services Group</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>
<!-- PÁGINA 10 - EXHIBIT B: Benefits Waiver for Prime Associates -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:10px;">EXHIBIT B</h2>
    <h3 style="text-align:center; margin-top:0;">BENEFITS WAIVER FOR PRIME ASSOCIATES</h3>

    <p>
      <strong>Agreement and Waiver</strong><br>
      Considering my assignment to CLIENT by PRIME, I agree that I am solely an employee of PRIME for benefits plan purposes
      and am eligible only for such benefits as PRIME may offer me as its employee. I further understand and agree that I am not suitable for or
      entitled to participate in or make any claim upon any benefit plan, policy, or practice offered by CLIENT, its parents, affiliates, subsidiaries,
      or successors to any point of their direct employees, regardless of the length of my assignment to CLIENT by PRIME and regardless of whether
      I am held to be a common-law employee of CLIENT for any purpose; and therefore, with full knowledge and understanding, I at this moment
      expressly waive any claim or right that I may have, now or in the future, to such benefits and agree not to make any claim for such uses.
    </p>

    <br><br>

    <table style="width:100%; font-size:20px; table-layout:fixed; color:#1c2969;">
      <tr>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>{{ $contract->client->address->name_account }}</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">

            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>Prime Facility Services Group</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>

<!-- PÁGINA 11 - EXHIBIT C: Confidentiality Agreement for Assigned Employees -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:10px;">EXHIBIT C</h2>
    <h3 style="text-align:center; margin-top:0;">CONFIDENTIALITY AGREEMENT FOR ASSIGNED EMPLOYEES</h3>

    <p><strong>Assigned Employee Confidentiality Agreement</strong></p>

    <p>As a condition of my assignment by PRIME to CLIENT, I at this moment agree as follows:</p>

    <ul>
      <li>I will not use, disclose, or in any way reveal or disseminate to unauthorized parties any information I gain through contact with materials or documents made available through my assignment at CLIENT or which I learn about during such assignment.</li>
      <li>I will not disclose, in any way, reveal or disseminate any information about CLIENT or its operating methods and procedures that come to my attention because of this assignment.</li>
      <li>Under no circumstances will I remove physical or electronic documents or copies of documents from CLIENT's premises.</li>
      <li>I understand that I will be responsible for any direct or consequential damages resulting from any violation of this Agreement.</li>
      <li>The obligations of this Agreement will survive my employment by PRIME.</li>
    </ul>
    <br><br>
    <table style="width:100%; font-size:20px; table-layout:fixed; color:#1c2969;">
      <tr>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>{{ $contract->client->address->name_account }}</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">

            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
        <td style="width:50%; vertical-align:middle; padding:15px; text-align:center;">
          <strong>Prime Facility Services Group</strong><br><br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Signature
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Printed Name
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Title
          </div>
          <br>
          <div style="border-bottom:2px solid #1c2969; width:90%; margin:0 auto; padding-bottom:40px;">
            Date
          </div>
        </td>
      </tr>
    </table>
  </div>
</div>

<!-- PÁGINA 12 - OPTIONAL PROVISIONS -->
<div class="page">
  <div class="content">
    <h2 style="text-align:center; margin-bottom:10px;">OPTIONAL PROVISIONS</h2>

    <h3>Emergency Provision</h3>
    <p>
      Prime Facility Services Group will perform the necessary services by the terms stipulated in this Agreement remotely via email and conferences.
      It is usually typical for Prime Facility Services Group to perform several site visits per week to the Client's place of business to obtain needed documents and review employee performance.
      Emergency Provisions and site visits will be limited and only necessary if required.
    </p>

    <h3>Price Increase</h3>
    <p>
      Starting from the contract inception date, an annual price increase clause of 6% shall be incorporated into this Agreement.
      Each year, on the anniversary of the contract commencement, the agreed-upon prices for the products or services provided under this Agreement will be subject to an upward adjustment following prevailing market conditions, inflation rates, and any other relevant factors.
      The price increase percentage shall be determined through a mutual agreement in good faith.
      This provision ensures that the pricing remains fair and reflects the current economic climate, enabling both parties to sustain a successful and beneficial long-term business relationship.
    </p>

    <h3>Insurance</h3>
    <p>
      During the term of this Agreement and so long after that, as Contractor may have any obligation to CLIENT under this Agreement, Contractor shall at its own cost and expense procure and maintain in full force and effect (or cause to be procured and maintained at no cost to CLIENT) insurance with sound and reputable insurance companies of the type and in such amounts as adequate for all risks by sound and prudent business practices for the type of business operation, activities, and services to be provided and performed by Contractor under this Agreement and as approved by CLIENT from time to time, including, without limitation, (i) worker’s compensation and employer’s liability, (ii) general liability, (iii) automobile liability and (iv) protective liability.
    </p>

    <p>
      In no event shall the insurance coverage required hereunder fall below the amounts set forth on Exhibit ___ attached hereto and incorporated herein by reference.
      Upon the execution of this Agreement, Contractor shall immediately provide to CLIENT true and accurate Certificates of Insurance (endorsed adequately by an authorized representative of the insurance company) evidencing that the insurance required hereunder is in force and effect and that such insurance will not be canceled or materially changed without giving CLIENT at least thirty (30) days prior written notice.
      Except to the extent prohibited by applicable Federal or State law, CLIENT shall be named as an additional insured and loss.
    </p>
  </div>
</div>

<!-- PÁGINA 13 -->
<div class="page">
  <div class="content">
    <p>
      Payee on all such insurance policies. The Contractor's requirement to procure and maintain such insurance coverage shall not negate or reduce Contractor’s obligations.
      CLIENT shall have the right to require Contractor to increase the amounts and otherwise upgrade the insurance provided by Contractor hereunder as CLIENT deems appropriate in its reasonable discretion.
      This section 9 shall survive the expiration or termination of this Agreement.
    </p>

    <p>
      [As necessary, per negotiation--] On CLIENT’s request, PRIME will give CLIENT certificates of this insurance coverage or, with the insurer’s concurrence, make CLIENT an additional insured for PRIME’s services.
    </p>

    <h3>Late Payment Penalty</h3>
    <p>
      CLIENT agrees to pay net within 15 to 30 days from the date of the invoice and to pay interest on any unpaid balances after the agreed payment term at the compounded rate of 3.5% per day (Annual Percentage Rate of 3.5%) or the maximum legal rate, whichever one is higher, calculated from the end of the payment term.
    </p>

    <h3>No Staff Hire - Always; Fee</h3>
    <p>
      CLIENT and PRIME agree not to directly or indirectly engage the services of any personnel directly involved in the execution of this Agreement, without prior written consent from the other party, for the duration of the Agreement and for two years thereafter.
      Any party violating this paragraph will pay the other party a fee for 30% of the employee’s annualized compensation within the new employer.
    </p>

    <h3>Nature of Relationship</h3>
    <p>
      The services that PRIME will render to CLIENT under this agreement will be as an independent contractor.
      Nothing contained in this Agreement will be construed to create the relationship of principal and agent, or employer and employee, between PRIME and CLIENT.
    </p>

    <h3>Headings</h3>
    <p>
      The headings of the paragraphs of this Agreement are inserted for the convenience of reference.
      They will in no way define, limit, extend, or aid in the construction of the scope, extent, or intent of this Agreement.
    </p>

    <h3>Arbitration</h3>
    <p>
      In the event of any controversy or dispute arising from this Agreement, the party at fault will be responsible for covering all expenses related to arbitration, as per the Federal Arbitration Act and before the American Arbitration Association (AAA) at the AAA location in Texas closest to PRIME's office.
    </p>
  </div>
</div>

<!-- PÁGINA 14 -->
<div class="page">
  <div class="content">
    <p>
      The prevailing party will be entitled to receive reasonable attorney's fees incurred during the arbitration process,
      and any other relief granted by the arbitrator will be binding upon the parties.
      The arbitrator, however, shall not have the authority to modify any terms of this Agreement.
      It should be noted that any award rendered by the arbitrator can be entered in any court of competent jurisdiction — contract interpretation.
    </p>

    <h3>Choice of Law</h3>
    <p>
      This agreement will be governed by and construed by the laws of Texas without reference to any conflicts of law principles thereof.
    </p>

    <h3>Assignment of Agreement</h3>
    <p>
      CLIENT shall not transfer or assign this Agreement without the written consent of PRIME,
      and any attempted assignment without such consent shall immediately terminate this Agreement.
    </p>
  </div>
</div>