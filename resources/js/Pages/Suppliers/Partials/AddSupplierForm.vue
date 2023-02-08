<template>
    <form @submit.prevent="submitSupplier"
          class="flex flex-col gap-5">
        <div class="flex justify-between">
            <h3 class="text-xl text-purchaser-primary font-bold rounded px-2">
                Firma (erforderlich)
            </h3>
            <div class="flex gap-4 justify-end">
                <BaseButton type="submit"
                            color="primary">Speichern
                </BaseButton>
                <BaseButton :href="route('suppliers')"
                            color="light">Zurück
                </BaseButton>
            </div>
        </div>
        
        <div class="flex gap-5">
            <div class="w-1/2">
                <InputLabel for="company"
                            value="Firma Name *" />
                <TextInput
                    id="company"
                    v-model="supplierForm.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>
            
            <div class="w-1/2">
                <InputLabel for="companyEmail"
                            value="Firma E-Mail *" />
                <TextInput
                    id="companyEmail"
                    v-model="supplierForm.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                />
            </div>
        </div>
    </form>
</template>

<script setup>

import BaseButton from "@/Components/BaseButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const props = defineProps(
    {
        supplier : {
            default: null,
            type   : Object,
        },
        addresses: Array,
        persons  : Array,
    })

const supplierForm = useForm(
    {
        name     : props.supplier?.name,
        email    : props.supplier?.email,
        addresses: null,
        persons  : null,
    }
)

function submitSupplier() {
    if (props.addresses.length)
        supplierForm['addresses'] = props.addresses
    
    if (props.persons.length)
        supplierForm['persons'] = props.persons
    
    if (props.supplier) {
        supplierForm.put(route('suppliers.put',
                               {
                                   'id'   : props.supplier.id,
                                   'name' : supplierForm.name,
                                   'email': supplierForm.email,
                               }))
    } else {
        supplierForm.post(route('suppliers.store'))
    }
    
}
</script>