@if ($paginator->hasPages())
    <nav class="paginacion">
        {{-- Mensaje informativo de resultados --}}
        <div class="paginacion-info">
            Mostrando {{ ($paginator->currentPage() - 1) * $paginator->perPage() + 1 }}
            - {{ min($paginator->currentPage() * $paginator->perPage(), $paginator->total()) }}
            de {{ $paginator->total() }} resultados
        </div>

        <ul class="paginacion-lista">
            {{-- Botón anterior --}}
            @if ($paginator->onFirstPage())
                <li class="deshabilitado">Anterior</li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}">Anterior</a></li>
            @endif

            {{-- Enlaces numerados --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="separador">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="activo">{{ $page }}</li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botón siguiente --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}">Siguiente</a></li>
            @else
                <li class="deshabilitado">Siguiente</li>
            @endif
        </ul>
    </nav>
@endif
