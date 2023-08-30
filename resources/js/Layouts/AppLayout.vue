<script setup>

</script>

<template>
    <div class="container mx-auto">
        <nav class="flex sticky-top justify-between px-6 py-3 border-b-4 border-green-700 bg-gradient-to-r from-green-600 to-green-900">
            <p class="font-bold text-white text-2xl">
                ¿cuandovoyaserlibre.info?
            </p>
            <div class="flex text-white font-bold">
                <button class="mr-4 hover:underline">¿Qué es esto?</button>
                <button class="mr-4 hover:underline">Registrate</button>
                <button class="hover:underline">Iniciar Sesión</button>
            </div>
        </nav>
        
        <slot/>

        <footer class="bg-green-900 border-t-4 border-white">
            <div class="flex justify-center text-white py-4">
                <p class="mr-1">Creardo por</p>
                <p class="font-bold">Marco Castillo</p>
            </div>
        </footer>
    </div>
  
</template>