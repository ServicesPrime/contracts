<table class="texto-normal" style="margin: 40px auto; text-align: center; width: 90%; border-collapse: collapse;">
    <tr>
        <!-- Columna Cliente -->
        <td style="padding: 20px; vertical-align: top; width: 50%;">
            <div class="subtitulo-sin" style="margin-bottom: 40px; text-align: center;">
                {{ $clientName ?? 'CLIENT COMPANY' }}
            </div>

            @foreach (['Signature', 'Printed Name', 'Title', 'Date'] as $label)
                <div class="signature-block" style="margin-bottom: 30px;">
                    <div class="signature-line" style="border-bottom: 1px solid #a00; margin-bottom: 8px; height: 2px;"></div>
                    <span>{{ $label }}</span>
                </div>
            @endforeach
        </td>

        <!-- Columna Prime -->
        <td style="padding: 20px; vertical-align: top; width: 50%;">
            <div class="subtitulo-sin" style="margin-bottom: 40px; text-align: center;">
                Prime Facility Services Group
            </div>

            @foreach (['Signature', 'Printed Name', 'Title', 'Date'] as $label)
                <div class="signature-block" style="margin-bottom: 30px;">
                    <div class="signature-line" style="border-bottom: 1px solid #a00; margin-bottom: 8px; height: 2px;"></div>
                    <span>{{ $label }}</span>
                </div>
            @endforeach
        </td>
    </tr>
</table>
