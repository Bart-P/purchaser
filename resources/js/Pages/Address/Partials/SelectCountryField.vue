<template>
    <div>
        <InputLabel for="country" value="Land *" />
        <div class="flex items-center gap-4">
            <TextInput @keyup="selectCountryWithDebounce($event.target.value)" :model-value="countryCode" id="country"
                type="text" class="mt-1 block max-w-[50px] text-center uppercase" required />
            <BaseButton @click="toggleCountryDropdown()" color="light"
                class="mt-1 flex justify-between items-center border-gray-300 border-[1px] rounded-md bg-gray-50 min-w-[300px]"
                type="button">
                <div v-if="countryCode && countries[countryCode.toUpperCase()]">
                    {{
                        countries[countryCode.toUpperCase()]
                    }}
                </div>
                <div v-else-if="countryCode">...</div>
                <div v-else>Auswählen</div>

                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </BaseButton>

            <div class="relative overflow-visible">
                <!-- Dropdown menu -->
                <Transition>
                    <div v-show="showCountryDropdown"
                        class="z-10 bg-white rounded-md shadow w-60 dark:bg-gray-700 absolute bottom-[25px] right-4 w-[300px]">
                        <ul class="max-h-96 py-2 overflow-y-auto text-gray-700 dark:text-gray-200">
                            <li v-for="country in filteredCountryCodes">
                                <div @click="selectCountry(country[0])"
                                    class="cursor-pointer flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    {{ country.join(' - ') }}
                                </div>
                            </li>
                        </ul>

                        <TextInput v-model="searchCountryTerm" @focusout="closeCountryDropdown" type="text" class=""
                            placeholder="Suchen"></TextInput>
                    </div>
                </Transition>

            </div>
        </div>
    </div>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { CountryCodes } from '@/Localisation/CountryCodes';
import { computed, ref } from 'vue';

const props = defineProps(
    {
        countryCode: {
            type: String,
            default: 'DE',
        },
    })

const emit = defineEmits(['selectCountry'])

let countries = CountryCodes.de
let showCountryDropdown = ref(false)
let searchCountryTerm = ref('')
let filteredCountryCodes = computed(
    () => Object.entries(countries)
        .filter((el) =>
            el[0].toLowerCase()
                .includes(searchCountryTerm.value)
            || el[1].toLowerCase()
                .includes(searchCountryTerm.value)))


function toggleCountryDropdown() {
    showCountryDropdown.value = !showCountryDropdown.value
}

function closeCountryDropdown() {
    showCountryDropdown.value = false
}

let timeout = null;

function selectCountryWithDebounce(countryCode) {
    if (timeout) {
        clearTimeout(timeout)
    }
    timeout = setTimeout(() => {
        selectCountry(countryCode)
    }, 200)
}

function selectCountry(countryCode) {
    emit('selectCountry', countryCode.toUpperCase())
    closeCountryDropdown()
}
</script>

<style scoped></style>
