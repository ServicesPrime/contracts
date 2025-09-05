{{-- resources/views/contracts/pagina5.blade.php --}}

<!-- ====== PÁGINA 5 - NOTICES ====== -->
<div class="page">
    @include('contractsHospitality.styles')
    <x-watermarkhospitality />

    <!-- Número de página -->
    <div class="page-number">{{ $pageNumber ?? 5 }}</div>

    <div class="content-padding" style="position: relative; z-index: 2;">
        
        <h2 class="notices-title">NOTICES</h2>
        
        <p class="texto-normal">
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
                        {{ $contract->client->address->name_account ?? $client->address->name_account ?? null }}<br>
                        {{ $contract->client->address->street ?? $client->address->street ?? null }}<br>
                        {{ $contract->client->address->city ?? $client->address->city ?? null}}, {{ $contract->client->address->state ?? $client->address->state ?? null}} {{ $contract->client->address->zip_code ?? $client->address->zip_code ?? null}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 150px; text-align: right; vertical-align: top; color: #b41f24; font-weight: bold; font-size: 11pt; font-family: Arial, sans-serif; border: none;">
                        Attn:
                    </td>
                    <td style="width: 20px; border: none;"></td>
                    <td style="text-align: left; vertical-align: top; color: #1c2969; font-size: 11pt; line-height: 1.5; font-family: Arial, sans-serif; border: none;">
                        {{ $contract->client->name ?? $client->name ?? null}}<br>
                        {{ $contract->client->phone ?? $client->phone ?? null}}<br>
                        {{ $contract->client->email ?? $client->email ?? null}}
                    </td>
                </tr>
            </table>
        </div>

        <div class="texto-normal" >
            Moreover, if to Contractor shall be sufficient in all respects if delivered in 
            person or sent by a nationally recognized overnight courier service or by 
            registered or certified mail to:
        </div>
        <br>

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

<x-footer-pages-hospitality />
