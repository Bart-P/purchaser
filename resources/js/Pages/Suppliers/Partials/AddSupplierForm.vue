<template>
    <form @submit.prevent="submitSupplier"
          class="flex flex-col gap-5">
        <div class="flex justify-between">
            <h3 class="heading-3">
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

        <hr class="my-5">

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h4 class="heading-4">Kategorien (erforderlich)</h4>
                <BaseButton id="dropdownSearchButton"
                            data-dropdown-toggle="dropdownCategorySearch"
                            data-dropdown-placement="bottom"
                            class="inline-flex items-center"
                            type="button">Kategorie Auswählen
                    <svg class="w-4 h-4 ml-2"
                         aria-hidden="true"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"></path>
                    </svg>
                </BaseButton>
            </div>

            <ul class="flex flex-wrap items-center gap-4 uppercase">
                <TransitionGroup>
                    <li class="py-2 px-3 border-[1px] border-purchaser-primary rounded-md shadow-md text-purchaser-primary"
                        v-for="cat in checkedCategories"
                        :key="'cat-key-' + cat.id">
                        {{ cat.name }}
                    </li>
                </TransitionGroup>

                <li
                    class="py-2 px-3 border-[1px] border-white rounded-md text-red-700 float-left"
                    v-show="!checkedCategories.length">*Bitte eine Kategorie auswählen
                </li>
            </ul>

            <SelectCategoryDropdown id="dropdownCategorySearch"
                                    @toggle-check-category="toggleCheckCategory"
                                    :checked-categories="checkedCategories"
                                    :categories="categories" />


        </div>


        <hr class="my-5">

        <div class="space-y-6">
            <div class="flex justify-between items-center">
                <h4 class="heading-4">Tags (optional)</h4>
                <BaseButton id="dropdownSearchButton"
                            class="inline-flex items-center"
                            type="button">Tag Auswählen
                    <svg class="w-4 h-4 ml-2"
                         aria-hidden="true"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M19 9l-7 7-7-7"></path>
                    </svg>
                </BaseButton>
            </div>

            <ul class="flex flex-wrap items-center gap-4 uppercase">

            </ul>
        </div>
    </form>
</template>

<script setup>

import BaseButton from '@/Components/BaseButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectCategoryDropdown from '@/Components/SelectCategoryDropdown.vue';
import TextInput from '@/Components/TextInput.vue';
import Toast from '@/Stores/toast';
import {useForm} from '@inertiajs/inertia-vue3';
import {initDropdowns} from 'flowbite';
import {onMounted, ref} from 'vue';

onMounted(() => {
    initDropdowns();
})

const props = defineProps(
    {
        supplier          : {
            default: null,
            type   : Object,
        },
        categories        : Object,
        supplierCategories: {
            type   : Object,
            default: null,
        },
        addresses         : Array,
        persons           : Array,
    })

const checkedCategories = ref([]);

if (props.supplierCategories) {
    checkedCategories.value = props.supplierCategories
}

const supplierForm = useForm(
    {
        name      : props.supplier?.name,
        email     : props.supplier?.email,
        addresses : null,
        persons   : null,
        categories: checkedCategories,
    },
)

function toggleCheckCategory(category) {
    if (checkedCategories.value.some((cat => cat['id'] === category.id))) {
        checkedCategories.value = checkedCategories.value.filter((cat) => cat['id'] !== category.id)
    } else {
        checkedCategories.value = [...checkedCategories.value, category]
    }
}

function submitSupplier() {

    if (!checkedCategories.value.length) {
        Toast.add(
            {
                'message': 'Bitte mindestens eine Kategorie auswählen',
                'type'   : 'warning',
            });
        return
    }

    if (props.addresses.length) {
        supplierForm['addresses'] = props.addresses
    }

    if (props.persons.length) {
        supplierForm['persons'] = props.persons
    }

    if (props.supplier) {
        supplierForm.put(
            route('suppliers.put',
                  {
                      'id'        : props.supplier.id,
                      'name'      : supplierForm.name,
                      'email'     : supplierForm.email,
                      'categories': checkedCategories,
                  }))
    } else {
        supplierForm.post(route('suppliers.store'))
    }
}
</script>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.2s ease-in-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>