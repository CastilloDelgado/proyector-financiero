<script setup>
import { onMounted } from 'vue';

const generateYear = (yearId) => [...Array(365)].map((day, index) => {
    const date = new Date(`1/1/${yearId}`)
    date.setDate(date.getDate() + index)
    return date
})

// const arrangeYear = Object.groupBy(generateYear(2023), (date) => date.getMonth())

const arrangeYear = () => {
    const result = {}
    const year = generateYear(2022)
    console.log(year)
    year.forEach((date => {
        if(!result[date.getMonth()]){
            result[date.getMonth()] = [date]
        } else {
            result[date.getMonth()].push(date)
        }
    }))
    return result
}

onMounted(() => {
    console.log(arrangeYear())
})

</script>

<template>
    <div class="w-full flex justify-center p-4">
        <div class="bg-blue-100 w-1/4">
            <div>
                <p class="text-center font-bold text-xl">Mes</p>
                <!-- <p class="text-center font-bold text-xl">{{ month.title }}</p> -->
                <div class="flex justify-between">
                    <div v-for="day in ['D','L','M','M','J','V','S']">
                        <p class="text-sm px-4 w-full">
                            {{ day }}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>