<script setup>
import { watch } from 'vue';
import { computed } from 'vue';
import { ref } from 'vue';

const montoInicial = ref(1702000)
const pagosCantidad = ref(240)
const porcentajeInteresAnual = ref(9.1)
const frecuenciaDePago = ref(30)
const montoPago = ref()

const PMT = (rate, nper, pv, fv, type) => {
    /*
        * rate   - interest rate per month
        * nper   - number of periods (months)
        * pv   - present value
        * fv   - future value
        * type - when the payments are due:
        *        0: end of the period, e.g. end of month (default)
        *        1: beginning of period
        */
    let pmt, pvif;

    fv || (fv = 0);
    type || (type = 0);

    if (rate === 0)
        return -(pv + fv) / nper;

    pvif = Math.pow(1 + rate, nper);
    pmt = - rate * (pv * pvif + fv) / (pvif - 1);

    if (type === 1)
        pmt /= (1 + rate);
    return pmt * -1;
}
  
watch([montoInicial, porcentajeInteresAnual, pagosCantidad], () => {
    if(
        montoInicial.value !== undefined &&
        porcentajeInteresAnual.value !== undefined &&
        pagosCantidad.value !== undefined 
    ) {
        montoPago.value = PMT((porcentajeInteresAnual.value/100/(Math.floor(365/frecuenciaDePago.value))), pagosCantidad.value, montoInicial.value, 0,0).toFixed(2)
    }
})

const paymentsTable = computed(() => {
    if (
        montoInicial.value !== undefined &&
        pagosCantidad.value !== undefined &&
        porcentajeInteresAnual.value !== undefined &&
        frecuenciaDePago.value !== undefined &&
        montoPago.value !== undefined
    ) {
        let montoInicialAnterior = montoInicial.value.toFixed(2)
        const periodos = [...Array(pagosCantidad.value)].map((_, index) => {
            const periodo = {}
            periodo.id = index + 1,
            periodo.montoInicial = montoInicialAnterior,
            periodo.montoInteres = (periodo.montoInicial * ((porcentajeInteresAnual.value/(Math.floor(365/frecuenciaDePago.value)))/100)).toFixed(2),
            periodo.montoInteresConIva = (periodo.montoInteres),
            periodo.montoPago = montoPago.value,
            periodo.montoAbonoCapital = (montoPago.value - periodo.montoInteresConIva).toFixed(2),
            periodo.montoRestante = (periodo.montoInicial - periodo.montoAbonoCapital).toFixed(2)
            
            montoInicialAnterior = periodo.montoRestante
            
            return periodo
        })

        const totales = {
            id: 0,
            montoInicial: 0,
            montoInteres: 0,
            montoInteresConIva: 0,
            montoPago: 0,
            montoAbonoCapital: 0,
            montoRestante: 0,
        }

        periodos.forEach(periodo => {
            totales.montoInteres = (parseFloat(totales.montoInteres) + parseFloat(periodo.montoInteres)).toFixed(2)
            totales.montoInteresConIva = (parseFloat(totales.montoInteresConIva) + parseFloat(periodo.montoInteresConIva)).toFixed(2)
            totales.montoPago = (parseFloat(totales.montoPago) + parseFloat(periodo.montoPago)).toFixed(2)
            totales.montoAbonoCapital = (parseFloat(totales.montoAbonoCapital) + parseFloat(periodo.montoAbonoCapital)).toFixed(2)
        })

        periodos.push({...totales})
        
        return periodos
    } else {
        return []
    }
})

</script>

<template>
    <div class="flex justify-center gap-4 mx-2">
        <div class="border-2 border-blue-300 rounded-md w-1/4 p-2 my-2 fixed top-0 left-2 right-0 bg-blue-50">
            <form action="" class="flex flex-col ">
                <label for="montoInicial" class="mb-2">Monto Inicial</label>
                <input v-model="montoInicial" class="border-blue-300 mb-2" id="montoInicial" type="number" placeholder="Ingresa el monto inicial">
                <label for="montoInicial" class="mb-2">Frecuencia de Pago (Días)</label>
                <input v-model="frecuenciaDePago" class="border-blue-300 mb-2" id="montoInicial" type="number" placeholder="Frecuencia de Pago en Días">
                <label for="montoInicial" class="mb-2">Porcentaje de Interes Anual</label>
                <input v-model="porcentajeInteresAnual" class="border-blue-300 mb-2" id="montoInicial" type="number" placeholder="Ingresa el monto inicial">
                <label for="montoInicial" class="mb-2">Cantidad de Pagos</label>
                <input v-model="pagosCantidad" class="border-blue-300 mb-2" id="montoInicial" type="number" placeholder="Ingresa el monto inicial">
                <label for="montoInicial" class="mb-2">Monto del Pago</label>
                <input v-model="montoPago" disabled class="border-blue-300 mb-2" id="montoInicial" type="number" placeholder="Ingresa el monto inicial">
                <input v-model="montoPago" disabled type="range" min="0" max="20000" step="10">
            </form>
        </div>
        <div class="w-1/4"></div>
        <div class="border-2 border-blue-300 rounded-md w-3/4 p-2 my-2">
            <p class="text-2xl font-bold mb-4">Tabla de Amortización</p>
            <table class="table-auto w-full border-2 border-blue-200 rounded-lg">
                <thead class="bg-blue-400 font-bold text-white">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Monto Inicial del Periodo
                        </th>
                        <th>
                            Monto de Interés
                        </th>
                        <th>
                            Monto de Interés + IVA
                        </th>
                        <th>
                            Pago del Periodo
                        </th>
                        <th>
                            Abono a Capital
                        </th>
                        <th>
                            Monto Restante del Periodo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(period, index) in paymentsTable" class="text-right" :class="index % 2 ? 'bg-gray-200' : ''">
                        <td class="font-bold">{{ period.id}}</td>
                        <td>{{ period.montoInicial }}</td>
                        <td>{{ period.montoInteres }}</td>
                        <td>{{ period.montoInteresConIva }}</td>
                        <td>{{ period.montoPago }}</td>
                        <td>{{ period.montoAbonoCapital }}</td>
                        <td>{{ period.montoRestante }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>