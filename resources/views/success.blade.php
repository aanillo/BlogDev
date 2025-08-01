<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pago Aceptado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-4xl font-bold mb-4 text-center">¡Gracias por tu compra!</h1>
        <p class="text-lg text-center mb-6">Tu pago se ha procesado correctamente</p>

        <a href="{{ route('home') }}" class="mt-6 block text-center text-blue-600 underline">
            Volver a la tienda
        </a>
    </div>

</body>
</html>