{{-- resources/views/contracts/pagina5.blade.php --}}

<!-- ====== PÁGINA 5 - NOTICES ====== -->
<div class="page">

    <x-watermark />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 5 }}</div>

    <div class="content content-with-padding" style="position: relative; z-index: 2;">
        
        <h2 class="notices-title">NOTICES</h2>
        
        <p class="notices-intro">
            All notices required under this Agreement shall be in writing, and if to the 
            <strong>CLIENT</strong> shall be sufficient in all respects if delivered in person or sent by a 
            nationally recognized overnight courier service or by registered or certified 
            mail to:
        </p>

        <!-- Tabla CLIENT centrada con ancho fijo -->
        <div style="text-align: center; margin: 25px 0;">
            <table style="border: none; border-collapse: collapse; display: inline-table; width: 600px;">
                <tr>
                    <td style="width: 150px; text-align: right; vertical-align: top; color: #b41f24; font-weight: bold; font-size: 11pt; font-family: Arial, sans-serif; border: none;">
                        Client:
                    </td>
                    <td style="width: 20px; border: none;"></td>
                    <td style="text-align: left; vertical-align: top; color: #1c2969; font-size: 11pt; line-height: 1.5; font-family: Arial, sans-serif; border: none;">
                        {{ $contract->client->address->name_account ?? null }}<br>
                        {{ $contract->client->address->street ?? null }}<br>
                        {{ $contract->client->address->city ?? null}}, {{ $contract->client->address->state ?? null}} {{ $contract->client->address->zip_code ?? null}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px; text-align: right; vertical-align: top; color: #b41f24; font-weight: bold; font-size: 11pt; font-family: Arial, sans-serif; border: none;">
                        Attn:
                    </td>
                    <td style="width: 20px; border: none;"></td>
                    <td style="text-align: left; vertical-align: top; color: #1c2969; font-size: 11pt; line-height: 1.5; font-family: Arial, sans-serif; border: none;">
                        {{ $contract->client->name ?? null}}<br>
                        {{ $contract->client->phone ?? null}}<br>
                        {{ $contract->client->email ?? null}}
                    </td>
                </tr>
            </table>
        </div>

        <div class="texto-normal" style="margin-bottom:15px; text-align: justify;" style="text-align: center; margin: 40px auto 20px; max-width: 75%; color: #1c2969; font-size: 11pt; line-height: 1.5;">
            Moreover, if to Contractor shall be sufficient in all respects if delivered in 
            person or sent by a nationally recognized overnight courier service or by 
            registered or certified mail to:
        </div>

        <!-- Tabla SERVICE PROVIDER centrada con mismo ancho -->
        <div style="text-align: center; margin: 25px 0;">
            <table style="border: none; border-collapse: collapse; display: inline-table; width: 600px;">
                <tr>
                    <td style="width: 150px; text-align: right; vertical-align: top; color: #b41f24; font-weight: bold; font-size: 11pt; font-family: Arial, sans-serif; border: none;">
                        Service Provider:
                    </td>
                    <td style="width: 20px; border: none;"></td>
                    <td style="text-align: left; vertical-align: top; color: #1c2969; font-size: 11pt; line-height: 1.5; font-family: Arial, sans-serif; border: none;">
                        Prime Facility Services Group<br>
                        8303 Westglen Dr<br>
                        Houston, Texas 77063
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px; text-align: right; vertical-align: top; color: #b41f24; font-weight: bold; font-size: 11pt; font-family: Arial, sans-serif; border: none;">
                        Attn:
                    </td>
                    <td style="width: 20px; border: none;"></td>
                    <td style="text-align: left; vertical-align: top; color: #1c2969; font-size: 11pt; line-height: 1.5; font-family: Arial, sans-serif; border: none;">
                        Patty Perez – President<br>
                        Or<br>
                        Rafael S. Perez Jr. – Sr. Vice President
                    </td>
                </tr>
            </table>
        </div>

    </div>
</div>

<x-footer-pages />
