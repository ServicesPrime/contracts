{{-- resources/views/contracts/pagina14.blade.php --}}

@php

    
    // Filtrar solo servicios que tienen service_id y son tipo 'service' (no términos y condiciones)
    $activeServices = [];
    if (isset($services) && is_array($services)) {
        $activeServices = array_filter($services, function($service) {
            // Los servicios son ahora modelos Service completos
            $hasServiceId = $service && !empty($service->form_data['service_id'] ?? '');
            $isServiceType = ($service->type ?? 'service') === 'service';
            return $hasServiceId && $isServiceType;
        });
    }
    
@endphp

@if(empty($activeServices))
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
    {{-- Primera página con header y servicios --}}
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

            @php
                $servicesPerPage = 3; // Ajustar según el espacio disponible
                $totalServices = count($activeServices);
                $currentPage = 1;
                $servicesOnCurrentPage = 0;
            @endphp

            @foreach($activeServices as $index => $service)
                @php
                    // Datos del servicio
                    $serviceName = $service->service ?? 'Service #' . ($index + 1);
                    $serviceSpecs = $service->specifications ?? collect();
                    $quantity = $service->form_quantity ?? '';
                    $unitPrice = $service->form_unit_price ?? '';
                    
                    $servicesOnCurrentPage++;
                    
                    Log::info('📄 PAGINA14: Procesando servicio', [
                        'service_id' => $service->id,
                        'service_name' => $serviceName,
                        'specifications_count' => $serviceSpecs->count(),
                        'current_page' => $currentPage,
                        'services_on_page' => $servicesOnCurrentPage
                    ]);
                @endphp

                {{-- Contenido del servicio --}}
                <div class="service-section" style="margin-bottom: 30px;">
                    <div class="subtitulo">{{ $serviceName }}</div>
                    <br>
                    <div class="texto-normal">
                        @if($serviceSpecs && $serviceSpecs->count() > 0)
                            {{-- Mostrar especificaciones como lista --}}
                            <ul style="list-style-type: disc; margin-left: 20px; line-height: 1.6;">
                                @foreach($serviceSpecs as $spec)
                                    <li>{{ $spec->description }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{-- Fallback si no hay especificaciones --}}
                            <p>This service will be performed according to industry standards and best practices. 
                            Detailed specifications will be provided upon service commencement.</p>
                        @endif
                    </div>
                    
                    {{-- Mostrar información contractual si está disponible --}}
                    @if(!empty($quantity) || !empty($unitPrice))
                        <div class="texto-normal" style="margin-top: 15px;">
                            <strong>Contract Details:</strong><br>
                            @if(!empty($quantity))
                                Quantity: {{ $quantity }}<br>
                            @endif
                            @if(!empty($unitPrice))
                                Unit Price: ${{ number_format($unitPrice, 2) }}<br>
                            @endif
                            @if(!empty($quantity) && !empty($unitPrice))
                                Subtotal: ${{ number_format($quantity * $unitPrice, 2) }}
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Verificar si necesitamos nueva página --}}
                @if($servicesOnCurrentPage >= $servicesPerPage && !$loop->last)
                    @php
                        $servicesOnCurrentPage = 0;
                        $currentPage++;
                    @endphp
                    
                    {{-- Cerrar página actual --}}
                    <br>
                </div>
            </div>
            <x-footer-pages />
            
            {{-- Nueva página sin header --}}
            <div class="page">
                <x-watermark />
                <div class="content-padding" style="position: relative; z-index: 2;">
                    {{-- Sin título ni texto introductorio en páginas adicionales --}}
                @endif
            @endforeach

            <div class="subtitulo">Service standards</div>
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
                CLIENT for such excess usage. These additional costs will be invoiced at the Contractor’s
                actual acquisition cost plus a ten percent (10%) markup. The Contractor shall provide written notice
                to the CLIENT in advance of any such anticipated overage, and an itemized statement or
                supporting documentation of the costs will be made available to the CLIENT upon request.
            </div>
            {{-- Cerrar la última página --}}
            <br>
        </div>
    </div>
    <x-footer-pages />
@endif