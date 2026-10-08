# Factura de Compra

Aplicación web en PHP que emite la factura de la compra de unidades de un artículo.

## Estructura

factura-compra/
├── index.html
├── css/
│   └── estilos.css
├── php/
│   └── facturar.php
└── README.md

## Funcionamiento

1. `index.html` muestra un formulario con la descripción del articulo, la cantidad y el precio unitario.
2. `php/facturar.php` recibe los datos y calcula:
   * Subtotal = cantidad * precio unitario
   * IVA = 12 % del subtotal
   * Total con IVA = subtotal + IVA
   * Descuento = 15 % del total con IVA, solo si este supera los 150 $
   * Total a pagar = total con IVA − descuento
3. Se muestra el desglose completo indicando si el descuento aplica o no.

