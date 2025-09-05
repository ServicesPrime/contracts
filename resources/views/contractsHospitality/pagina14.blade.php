{{-- resources/views/contracts/pagina14.blade.php --}}

@php
    use Illuminate\Support\Arr;

    /**
     * Normaliza cualquier fila a una estructura común para pintar en la vista.
     */
    $normalize = function ($row) {
        // A) ContractService (pivot) con relación ->service
        if ($row instanceof \App\Models\ContractService) {
            $svc = $row->service; // App\Models\Service | null
            return [
                'service_id'   => $row->service_id,
                'service_name' => $svc->service ?? ('Service #'.$row->service_id),
                'specs'        => $svc->specifications ?? collect(),
                'quantity'     => $row->quantity,
                'unit_price'   => $row->unit_price,
                'raw'          => $row,
            ];
        }

        // B) Service "enriquecido" (con form_*)
        if ($row instanceof \App\Models\Service) {
            return [
                'service_id'   => Arr::get($row->form_data ?? [], 'service_id', $row->id),
                'service_name' => $row->service ?? ('Service #'.$row->id),
                'specs'        => $row->specifications ?? collect(),
                'quantity'     => $row->form_quantity ?? null,
                'unit_price'   => $row->form_unit_price ?? null,
                'raw'          => $row,
            ];
        }

        // C) Array plano
        if (is_array($row)) {
            $serviceModel = $row['service'] ?? null; // puede venir embebido
            $name = is_array($serviceModel) ? ($serviceModel['service'] ?? null)
                  : (is_object($serviceModel) ? ($serviceModel->service ?? null) : null);
            $specs = is_array($serviceModel) ? ($serviceModel['specifications'] ?? [])
                  : (is_object($serviceModel) ? ($serviceModel->specifications ?? collect()) : []);

            return [
                'service_id'   => Arr::get($row, 'form_data.service_id', $row['service_id'] ?? null),
                'service_name' => $name ?? ('Service #'.($row['service_id'] ?? '')),
                'specs'        => $specs instanceof \Illuminate\Support\Collection ? $specs : collect($specs),
                'quantity'     => $row['form_quantity'] ?? $row['quantity'] ?? null,
                'unit_price'   => $row['form_unit_price'] ?? $row['unit_price'] ?? null,
                'raw'          => $row,
            ];
        }

        return null;
    };

    // Normaliza todo y quédate con los que tengan un service_id (sin importar type)
    $items = collect($services ?? [])->map($normalize)->filter();
    $activeServices = $items->filter(fn($i) => !empty($i['service_id']))->values();

    // Paginación simple por página
    $servicesPerPage = 3;
@endphp

@if($activeServices->isEmpty())
    {{-- Página por defecto si no hay servicios --}}
    <div class="page">
        <x-watermark />
        <div class="content-padding" style="position: relative; z-index: 2;">
            <div class="titulo">SERVICE SCOPE OF WORK</div>
            <br>
            <div class="texto-normal">
                Prime Facility Services Group will provide comprehensive facility management services for all 
                designated areas within the {{ $client->name ?? 'facility' }} campus. The following services will be 
                performed according to the specified schedule and quality standards outlined in this agreement.
            </div>
            <br>
            <div class="subtitulo">Services To Be Defined</div>
            <br>
            <div class="texto-normal">
                Please select services to see detailed specifications and scope of work.
            </div>
            <br>
        </div>
    </div>
    <x-footer-pages />
@else
    @php $chunks = $activeServices->chunk($servicesPerPage); @endphp

    @foreach($chunks as $pageIndex => $chunk)
        <div class="page">
            <x-watermark />
            <div class="content-padding" style="position: relative; z-index: 2;">
                @if($pageIndex === 0)
                    <div class="titulo">SERVICE SCOPE OF WORK</div>
                    <br>
                    <div class="texto-normal">
                        Prime Facility Services Group will provide comprehensive facility management services for all 
                        designated areas within the {{ $client->name ?? 'facility' }} campus. The following services will be 
                        performed according to the specified schedule and quality standards outlined in this agreement.
                    </div>
                    <br>
                @endif

                @foreach($chunk as $index => $item)
                    @php
                        $serviceName = $item['service_name'];
                        $specs       = $item['specs'] ?? collect();
                        $quantity    = $item['quantity'];
                        $unitPrice   = $item['unit_price'];
                    @endphp

                    <div class="service-section" style="margin-bottom: 30px;">
                        <div class="subtitulo">{{ $serviceName }}</div>
                        <br>
                        <div class="texto-normal">
                            @if($specs && $specs->count() > 0)
                                <ul style="list-style-type: disc; margin-left: 20px; line-height: 1.6;">
                                    @foreach($specs as $spec)
                                        <li>{{ $spec->description }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <p>
                                    This service will be performed according to industry standards and best practices. 
                                    Detailed specifications will be provided upon service commencement.
                                </p>
                            @endif
                        </div>

                        {{-- Info contractual (solo si hay datos); no depende del type --}}
                        @if(!empty($quantity) || !empty($unitPrice))
                            <div class="texto-normal" style="margin-top: 15px;">
                                <strong>Contract Details:</strong><br>
                                @if(!empty($quantity))
                                    Quantity: {{ $quantity }}<br>
                                @endif
                                @if(!empty($unitPrice))
                                    Unit Price: ${{ number_format((float)$unitPrice, 2) }}<br>
                                @endif
                                @if(!empty($quantity) && !empty($unitPrice))
                                    @php $subtotal = ((int)$quantity) * (float)$unitPrice; @endphp
                                    Subtotal: ${{ number_format($subtotal, 2) }}
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach

                {{-- Solo en la última página: agregar las 3 secciones finales --}}
                @if($loop->last)
                    <div class="subtitulo">Service Standards</div>
                    <br>
                    <div class="texto-normal">
                        All services will be performed to the highest professional standards using environmentally friendly
                        cleaning products where possible. Prime Facility Services Group will ensure that all work is completed
                        during designated hours to minimize disruption to educational activities.
                        Regular quality inspections will be conducted to ensure compliance with agreed-upon standards. Any
                        issues or concerns will be addressed promptly and professionally.
                    </div>
                    <br>
                    
                    <div class="subtitulo">Equipment and Supplies</div>
                    <br>
                    <div class="texto-normal">
                        Prime Facility Services Group will provide all necessary equipment, cleaning supplies, and materials
                        required to perform the services outlined in this scope of work. All equipment will be maintained in
                        good working condition and replaced as needed.
                    </div>
                    <br>
                    
                    <div class="subtitulo">Overage of Cleaning Supplies</div>
                    <br>
                    <div class="texto-normal">
                        If, due to emergencies, special occasions, Disinfection and Sanitization Services (such as those
                        required during public health events like COVID-19), or other unscheduled circumstances, the
                        performance of the Services requires cleaning chemicals, disinfectants, or related supplies in quantities
                        beyond what is reasonably anticipated in the scope of this Agreement, the Contractor may charge the
                        CLIENT for such excess usage. These additional costs will be invoiced at the Contractor's
                        actual acquisition cost plus a ten percent (10%) markup. The Contractor shall provide written notice
                        to the CLIENT in advance of any such anticipated overage, and an itemized statement or
                        supporting documentation of the costs will be made available to the CLIENT upon request.
                    </div>
                @endif

                <br>  
            </div>
        </div>
        <x-footer-pages />
    @endforeach
@endif