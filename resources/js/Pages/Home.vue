
<script setup>
import { Link } from '@inertiajs/vue3';
import image from "./header.png"

</script>

<template>
    <div class="container mx-auto">
        <nav class="flex justify-between px-4 py-2 bg-blue-600 border-b-4 border-white">
            <p class="font-bold text-2xl text-white">
                ¿Cuando voy a ser libre?
            </p>
            <div class="flex text-white">
                <button class="mr-4 hover:underline">Registrate</button>
                <button class="hover:underline">Iniciar Sesión</button>
            </div>
        </nav>
        <div>
            <div class="h-[80vh] bg-gradient-to-r from-red-500 to-blue-500 flex">
                <div class="flex w-2/3 items-center h-full">
                    <div class="flex justify-center">     
                        <p class="text-center text-8xl font-bold text-white flex flex-wrap px-12 -rotate-12">
                            ¡¡¿Cuando voy a ser libre?!!
                        </p>
                    </div>
                </div>
                <div class="w-1/3 flex items-end">
                    <img :src="image" alt="">
                </div>
            </div>
        </div>



        <div class="flex jusitfy-center">
            <Link href="/calculator"><button class="bg-blue-400 rounded-md text-white font-bold p-2 ml-2">Caluladora</button></Link>
            <Link href="/calendar"><button class="bg-blue-400 rounded-md text-white font-bold p-2 ml-2">Calendario</button></Link>
        </div>
    </div>
  
</template>