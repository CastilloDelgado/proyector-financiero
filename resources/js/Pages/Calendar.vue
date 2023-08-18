<script setup>
import { computed } from 'vue';

const generateYear = (yearId) => [...Array(365)].map((day, index) => {
    const date = new Date(`1/1/${yearId}`)
    date.setDate(date.getDate() + index)
    return date
})

const fullYear = () => {
    const result = {}
    const year = generateYear(1998)
    let week = 1
    year.forEach((date => {
        const monthId = date.toLocaleString('default', { month: 'long', })
        const day = date.toLocaleDateString('default', { weekday: 'long'})
        if(!result[monthId]){
            result[monthId] = {[week]: [date]}
        } else {
            if(!result[monthId][week]){
                result[monthId][week] = [date]
            } else {
                result[monthId][week].push(date)
            }
        }

        if(day === "Saturday"){
            week = week + 1
        }
    }))
    return result
}

const year = computed(() => Object.entries(fullYear()))

const fillWeek = (week) => {
    if(week.length < 7){
        if(week[0].getDate() === 1){
            return [...Array(7 - week.length), ...week]
        } else {
            return [...week, ...Array(7 - week.length)]
        }
    } else{
        return week
    }
}

</script>

<template>
    <div class="flex flex-wrap gap-2 justify-center m-2 ">
        <div v-for="[title, weeks] in year" class="bg-blue-100">
            <p class="px-6 font-bold text-xl my-2">{{ title }}</p>
            <div class="flex justify-between px-4 bg-gray-100 font-bold">
                <p v-for="day in ['D','L','M','M','J','V','S']" class="w-8 text-center">
                    {{ day }}
                </p>
            </div>
            <div v-for="[weekNumber, week] in Object.entries(weeks)" class="flex justify-between px-4 mb-2">
                <p v-for="date in fillWeek(week)" class="w-8 text-center">
                    {{ date?.getDate() }}
                </p>
            </div>
        </div>
    </div>
</template>