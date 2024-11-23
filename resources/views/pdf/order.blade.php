<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Pedido</title>

    <style>
       body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            max-width: 380px;
            margin: auto;
            color: #333;
        }
        .ticket {
            margin-top: 8px;
            width: 100%;
            border: 1px dashed #333;
            padding: 10px;
        }
        .ticket-header, .ticket-footer {
            text-align: center;
        }
        .ticket-header h2 {
            margin: 0;
            font-size: 18px;
        }
        .ticket-header p {
            margin: 0;
            font-size: 12px;
        }
        .ticket-info {
            margin: 10px 0px;
            text-align: left;
        }
        .ticket-info p {

            margin: 2px 0px;
            padding-right: 4px;
            font-weight: bold;
        }
        .ticket-info p span{
            
            padding-left: 4px;
            font-weight: 100;
           
        }

        .ticket-items {
            margin: 5px 0;
            border-top: 1px dashed #333;
            border-bottom: 1px dashed #333;
            padding: 4px 0px;
        }

        .ticket-items .item ul li{

            display: flex;
            align-items: center;

            margin: 12px 0px 0px 2px;
            font-size: 10px;
            width: 100%; /* Asegúrate de que el item ocupe el ancho completo */
        }

        .ticket-items .item .item-notas {

            display: block; /* Hace que item-notas ocupe toda la línea */
            margin-top: -5px; /* Opcional: espacio entre el precio y las notas */
            font-size: 12px; /* Ajusta el tamaño de la fuente si es necesario */
            flex-direction: column;

        }

        .item-name {
            flex: 3; /* Ajusta el ancho de este campo */
            text-align: left;
            font-weight: bold;
        }

        .item-qty, .item-price {
            flex: 1; /* Cada uno ocupará el mismo espacio */
            text-align: center;
        }

         .subtotal{
            display: flex !important;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }
        .ticket-footer {
            margin-top: 10px;
            font-size: 12px;
            border-top: 1px dashed #333;
            padding-top: 10px;
        }

        .ticket-items table thead tr{

            border-top: 1px dashed #333 !important;
            border-bottom: 1px dashed #333 !important;
           
        }

        .body_boton {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px; /* Ajusta según sea necesario */
        }

        .button-link{


            border-radius: 20px;
            text-decoration: none;
            background-color: #e70808;
            color: #fff;
            padding: 10px 20px;
        }

    </style>

</head>

<body>
        <!-- Header del ticket -->
        <div class="ticket-header">
            <h2>Restaurante Buen Sabor</h2>
            <p>Dirección: Av. Principal 123</p>
            <p>Tel: +56 123 456 7890</p>
            <p>Fecha: {{$date}} </p>
        </div>

        <!-- Información de la orden -->
        <div class="ticket-info">
            <table>
                <tbody>
                    <tr>
                        <td style="font-weight: bold">Orden de Pedido: </td>
                        <td> #{{ $order->id }}</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="font-weight: bold">Usuario: </td>
                        <td>{{ $user->name }}</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <tbody>
                    <tr>
                        <td style="font-weight: bold">Mesa: </td>
                        <td>{{ $table_name }}</td>
                    </tr>
                </tbody>
            </table>
          
        </div>

        <!-- Items del pedido -->
        <div class="ticket-items">

            <table style="width:100%;border-bottom: 1px dashed #333 !important; width: 100%">
                <thead  style="border-bottom: 1px dashed #333;">
                    <tr>
                        <th style="text-align:left">Nombre - Producto</th>
                        <th style="text-align:right; width: 40%; margin-right:-40px">Cantidad</th>

                        <th style="text-align:right">Precio Neto</th>
                    </tr>
                </thead>
            </table>
      
            <table style="width: 100%">
                
                <tbody style="margin-top:15px;">
                    @foreach ($items as $item)
                        <tr>
                            <td style="font-weight:bold">*{{ $item->product->name }}*</td>
                            <td style="text-align:center">{{ $item->quantity }}</td>
                            <td style="text-align:right">{{ $item->price }}</td>
                        </tr>
                        <tr class="notas">
                            <td colspan="3" style="margin-bottom: 10px">{{ $item->notes }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

        <!-- Totales -->
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: right; font-weight: bold; padding-right: 20px;">Sub-Total:</td>
                    <td style="text-align: right;">${{ $order->subtotal }}</td>
                </tr>
            </tbody>
        </table>
        
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: right; font-weight: bold; padding-right: 40px;">Impuestos:</td>
                    <td style="text-align: right;">${{ $order->iva }}</td>
                </tr>
            </tbody>
        </table>
        
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="text-align: right; font-weight: bold; padding-right: 40px;">Total Pagar:</td>
                    <td style="text-align: right; font-weight: bold;">${{ $order->total }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Footer del ticket -->
        <div class="ticket-footer">
            <p>Gracias por su visita</p>
            <p>¡Vuelva pronto!</p>
            <div class="body_boton">
                <a href="{{ $selectTableUrl }}" class="button-link">Mesas</a>
           </div>
        </div>

    </div> 

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (window.location.search.includes('print=true')) {
                window.print();
            }
        });
    </script>
    
</body>

</html>
