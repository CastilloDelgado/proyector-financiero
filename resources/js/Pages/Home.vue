
<script setup>
import { Link } from '@inertiajs/vue3';
import { TransitionRoot } from '@headlessui/vue'

import image from "./header.png"
import { ref } from 'vue';
import { onMounted } from 'vue';

const showTitle = ref(false)
const showPerson = ref(false)
const showButton = ref(false)

onMounted(() => {
  showTitle.value = true
  setTimeout(() => {showPerson.value = true}, 400)
  setTimeout(() => {showButton.value = true}, 1200)
})

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
        <div>
            <div class="h-[80vh] bg-gradient-to-r from-blue-500 border-t-4 border-white  to-green-500 flex">
                <div class="flex w-2/3 items-center h-full">
                    <div class="flex flex-col justify-center transition h-2/4">     
                        <TransitionRoot
                            appear 
                            :show="showTitle"
                            enter="transform transition duration-[600ms]"
                            enter-from="opacity-0 rotate-[-120deg] scale-0"
                            enter-to="opacity-100 rotate-0 scale-100"
                        >
                            <p class="text-center text-8xl font-bold text-white flex flex-wrap px-12 -rotate-6 transition mb-16">
                                ¡¡¿Cuando voy a ser libre?!!
                            </p>
                        </TransitionRoot>
                        <div class="flex justify-center h-1/4">
                            <TransitionRoot
                                :show="showButton"
                                enter="transform transition duration-[600ms]"
                                enter-from="translate-y-full opacity-0"
                                enter-to="translate-y-0 opacity-100"
                            >
                                <button class="text-xl px-6 py-2 font-bold bg-green-600 rounded-lg text-white border-2 border-white transition hover:scale-105 hover:bg-green-500">
                                    ¡Descubrelo aquí!
                                </button>
                            </TransitionRoot>
                        </div>
                    </div>
                </div>
                <div class="w-1/3 flex items-end">
                    <TransitionRoot 
                        :show="showPerson"
                        enter="transition ease-in-out duration-[1000ms]"
                        enter-from="translate-x-full opacity-0"
                        enter-to="translate-x-0 opacity-100"
                    >
                        <img :src="image" alt="">
                    </TransitionRoot>
                </div>
            </div>
        </div>

        <div class="h-[80vh] bg-gradient-to-r from-red-500 border-t-4 border-white to-blue-500 ">
            <div class="pt-24 h-1/4">
                <p class="text-center text-6xl font-bold text-white">Herramientas</p>
            </div>
            <div class="flex justify-center gap-6 items-center h-3/4">
                <Link href="/calculator" class="bg-blue-400 border-white border-4 text-white rounded-lg hover:scale-105 transition">
                    <div class="grid grid-cols-1 gap-4 place-content-center justify-center p-4">
                        <p class="font-bold text-2xl text-center">Calculadora</p>
                        <div class="justify-center w-full flex">
                            <img src="./calculator.png" alt="" class="w-64 justify-center">
                        </div>
                    </div>
                </Link>
                <Link href="/calendar" class="bg-red-500 border-white border-4 text-white  rounded-lg  hover:scale-105 transition">
                   <div class="grid grid-cols-1 gap-4 place-content-center justify-center p-4">
                        <p class="font-bold text-2xl text-center">Calendario</p>
                        <div class="justify-center w-full flex">
                            <img src="./calendar.jpg" alt="" class="w-64 justify-center">
                        </div>
                    </div>
                </Link>
            </div>
        </div>
    </div>
  
</template>