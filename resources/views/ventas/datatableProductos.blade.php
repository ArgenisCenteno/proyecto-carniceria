<!-- Modal -->
<div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="productosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning text-blakc">
                <h5 class="modal-title" id="productosModalLabel">Listado de Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="productos-table2">
                        <thead class="bg-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>IVA</th>
                                <th>Stock</th>
                                <th>Subcategoría</th>
                                <th>Unidad de Medida</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes cargar los datos dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#productosModal">
    Ver Productos
</button>

<h3 class="p-4 m-4 bold">Productos a vender</h3>
<div class="table-responsive">
    <table class="table table-hover" id="productos-ventas">
        <thead class="bg-light">
            <tr>

                <th>Nombre</th>
                <th>Precio</th>
                <th> IVA</th>
                <th>Unidad Medida</th>

                <th>Cantidad</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

@section('js')
@include('layout.script')
<script src="{{ asset('js/adminlte.js') }}"></script>
<script src="{{asset('js/sweetalert2.js')}}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        let productosEnCarrito = [];


        $('#productos-table2').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('ventas.datatableProductoVenta') }}",
            dataType: 'json',
            type: "POST",
            columns: [
                { data: 'nombre', name: 'nombre' },
                { data: 'descripcion', name: 'descripcion' },
                { data: 'precio_venta', name: 'precio_venta' },
                {
                    data: 'aplica_iva', name: 'aplica_iva', render: function (data) {
                        return data ? 'Sí' : 'No';
                    }
                },
                { data: 'cantidad', name: 'cantidad' },
                { data: 'subCategoria', name: 'subCategoria' },
                { data: 'unidad_medida', name: 'unidad_medida' },
                {
                    data: 'id',
                    name: 'actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {

                        return `<button type="button" class="btn btn-primary" onClick="modificarTabla('${data}')"><span>Agregar</span></button>`;
                    }
                }
            ],
            order: [[0, 'desc']],
            "language": {
                "lengthMenu": "Mostrar _MENU_ Registros por Página",
                "zeroRecords": "Sin resultados",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay Registros Disponibles",
                "infoFiltered": "Filtrado de _TOTAL_ de _MAX_ Registros Totales",
                "search": "Buscar",
                "paginate": {
                    "next": ">",
                    "previous": "<"
                }
            }
        });

    })
</script>


<script>
    var productos = [];
    var totalDolar = 0;
    var totalBS = 0;

    var tasaCambio = document.getElementById("dollar-tasa").value;
    function modificarTabla(id) {
        const url = `{{ route('productos.obtener', ':id') }}`.replace(':id', id); // Reemplaza :id con el valor de ID dinámico

        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al consultar el producto.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    console.log(data)
                    agregarProducto(
                        data.producto.nombre,
                        data.producto.precio_venta,
                        data.producto.aplica_iva,
                        data.producto.cantidad,
                        data.producto.sub_categoria.nombre,
                        data.producto.unidad_medida
                    );
                } else {
                    console.error(data);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Función para agregar un producto al carrito
    function agregarProducto(nombre, precio, iva, stock, subcategoria, unidad_medida) {
        const productoExistente = productos.find((p) => p.nombre === nombre);
        if (productoExistente) {
            if (productoExistente.cantidad < stock) {
                productoExistente.cantidad++;
                productoExistente.subtotal = calcularSubtotal(productoExistente);
            } else {
                Swal.fire({
                    title: 'Stock Excedido',
                    text: `La cantidad solicitada excede el stock disponible.`,
                    icon: 'info',
                    confirmButtonColor: '#3085d6'
                });
            }
        } else {

            var cantidad = 1;
            var cantidad2 = 1;
            if (unidad_medida == 'KILOGRAMOS' || unidad_medida == 'LITROS') {
                cantidad = cantidad * 1000;
                cantidad2 = cantidad / 1000;
            }

            const nuevoProducto = {
                nombre: nombre,
                precio: parseFloat(precio),
                iva: parseFloat(iva),
                stock: parseInt(stock),
                subcategoria: subcategoria,
                cantidad: cantidad,
                unidad_medida: unidad_medida,
                subtotal: calcularSubtotal({ precio, iva, cantidad: cantidad2 }),
            };
            productos.push(nuevoProducto);
        }
        actualizarTabla();
    }

    // Función para calcular el subtotal de un producto con IVA
    function calcularSubtotal(producto) {
        if (!producto.iva) {
            if (producto.unidad_medida == 'KILOGRAMOS' || producto.unidad_medida == 'LITROS') {
                cantidad = producto.cantidad / 1000
                return producto.precio * cantidad;
            } else {
                return producto.precio * producto.cantidad;
            }

        } else {
            if (producto.unidad_medida == 'KILOGRAMOS' || producto.unidad_medida == 'LITROS') {
                cantidad = producto.cantidad / 1000
                return producto.precio * 1.16 * cantidad;
            } else {
                return producto.precio * 1.16 * producto.cantidad;
            }

        }

    }

    // Función para aumentar la cantidad de un producto en el carrito
    function aumentarCantidad(nombre, unidad_medida, inputElement) {
        console.log(inputElement);
        let nuevaCantidad = parseFloat(inputElement.value); // Cambiado const a let para permitir reasignación

        // Ajusta la cantidad si es en KILOGRAMOS o LITROS
        if (unidad_medida === 'KILOGRAMOS' || unidad_medida === 'LITROS') {
            nuevaCantidad2 = nuevaCantidad / 1000;
        }

        // Buscar el producto en el array 'productos'
        const producto = productos.find((p) => p.nombre === nombre);

        if (producto) {
            // Si la cantidad es mayor al stock, ajustarla al máximo disponible
            if (nuevaCantidad2 > producto.stock) {
                inputElement.value = producto.stock; // Ajusta el valor del input al máximo disponible
                producto.cantidad = producto.stock; // Establece la cantidad en el stock disponible
                Swal.fire({
                    title: 'Stock Excedido',
                    text: `La cantidad solicitada excede el stock disponible. Se ajustó a ${producto.stock}.`,
                    icon: 'info',
                    confirmButtonColor: '#3085d6'
                });
            } else {
                producto.cantidad = nuevaCantidad; // Si la cantidad es válida, la asigna
            }

            // Calcular el subtotal con la nueva cantidad
            producto.subtotal = calcularSubtotal(producto);

            // Actualizar la tabla
            actualizarTabla();
        } else {
            Swal.fire({
                title: 'Producto no encontrado',
                text: 'No se ha encontrado el producto en el carrito.',
                icon: 'error',
                confirmButtonColor: '#3085d6'
            });
        }

        // Actualizar el pago
        pagado();
    }




    // Función para eliminar un producto del carrito
    function eliminarProducto(nombre) {
        productos = productos.filter((p) => p.nombre !== nombre);
        actualizarTabla();
        pagado();
    }

    // Función para actualizar la tabla del carrito y calcular totales
    function actualizarTabla() {
        const tbody = document.querySelector('#productos-ventas tbody');

        tbody.innerHTML = '';

        totalDolar = 0;
        totalBS = 0;

        productos.forEach((producto) => {
            totalDolar += producto.subtotal;
            totalBS += producto.subtotal * tasaCambio;

            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${producto.nombre}</td>
                <td>${producto.precio.toFixed(2)}</td>
                <td>${producto.iva ? 'SÍ' : 'NO'}</td>
                  <td>${producto.unidad_medida}</td>
            
               
               <td>
               <input type="number" class="form-control" step="any" unidad="${producto.unidad_medida}" value="${producto.cantidad}" 
    onChange="aumentarCantidad('${producto.nombre}', '${producto.unidad_medida}', this)">

            </td>
                     
<button class="btn btn-danger m-2" onclick="eliminarProducto('${producto.nombre}')">
    <span>Quitar</span>
</button>
                </td>
            `;
            tbody.appendChild(fila);
        });

        // Actualizar los totales
        document.getElementById('total-dolar').innerText = `${totalDolar.toFixed(2)}`;
        document.getElementById('total-bs').innerText = `${totalBS.toFixed(2)}`;
        document.getElementById('totalBolivares').value = `${totalBS.toFixed(2)}`;
    }


    function pagado() {
        // Obtener los valores de los métodos de pago
        var efectivo = parseFloat(document.querySelector('input[name="Efectivo"]').value) || 0;
        var punto = parseFloat(document.querySelector('input[name="Punto de Venta"]').value) || 0;
        var transferencia = parseFloat(document.querySelector('input[name="Transferencia"]').value) || 0;
        var pagoMovil = parseFloat(document.querySelector('input[name="Pago Movil"]').value) || 0;

        var divisa = parseFloat(document.querySelector('input[name="Divisa"]').value) || 0;
        var totalBS = parseFloat(document.getElementById("totalBolivares").value);
        // Obtener la tasa de cambio (en dólares)
        var tasaDollar = document.getElementById("dollar-tasa").value;


        var totalDolar = divisa;
        var totalDolar2 = divisa * tasaDollar;


        var totalBs = efectivo + punto + transferencia + pagoMovil + totalDolar2

        var restante = totalBS.toFixed(2) - totalBs.toFixed(2);

        console.log(restante, totalBS, totalBs)

        // Habilitar o deshabilitar el botón de "Generar Venta"
        if (totalBS.toFixed(2) == totalBs.toFixed(2) && totalBS > 0) {
            document.getElementById('submitBtn').disabled = false;
        } else {
            document.getElementById('submitBtn').disabled = true;
        }
        document.getElementById('restante').innerText = `${restante.toFixed(2)}`;

        // Asignar la función de actualización a los inputs
        document.querySelectorAll('input[name="Efectivo"], input[name="Punto de Venta"], input[name="Transferencia"], input[name="Pago Movil"], input[name="Biopago"], input[name="Divisa"]').forEach(input => {
            input.addEventListener('input', pagado);
        });

    }
    pagado();

</script>

<script>
    function enviarProductosFormulario() {
        const productosHiddenFieldsContainer = document.getElementById('productos-hidden-fields');
        productosHiddenFieldsContainer.innerHTML = ''; // Clear previous hidden fields

        productos.forEach(producto => {
            const hiddenFields = `
            <input type="hidden" name="productos[${producto.nombre}][nombre]" value="${producto.nombre}">
            <input type="hidden" name="productos[${producto.nombre}][precio]" value="${producto.precio}">
            <input type="hidden" name="productos[${producto.nombre}][cantidad]" value="${producto.cantidad}">
            <input type="hidden" name="productos[${producto.nombre}][subtotal]" value="${producto.subtotal}">
        `;
            productosHiddenFieldsContainer.innerHTML += hiddenFields;
        });
    }
    document.getElementById('venta-form').addEventListener('submit', function (event) {
        enviarProductosFormulario(); // Populate the hidden fields with product data
    });


</script>

@endsection