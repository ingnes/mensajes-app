<script setup>
import { router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
  messages: {
    type: Array,
    default: () => []
  }
});

function deleteMessage(id) {
  router.delete(route('mensajes.destroy', id));
}
</script>

<template>
    <AppLayout title="Mensajes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                  Lista de mensajes 😎
            </h2>            
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                    <table v-if="messages.length" class="w-full table-auto border-collapse border border-slate-400 text-center">
                        <thead class="text-sm bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="border border-slate-300 p-2">Nombre</th>
                                <th class="border border-slate-300 p-2">Email</th>
                                <th class="border border-slate-300 p-2">Mensaje</th>
                                <th class="border border-slate-300 p-2">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="m in messages" :key="m.id" class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="border border-slate-300 p-2">{{ m.name }}</td>
                                <td class="border border-slate-300 p-2">{{ m.email }}</td>
                                <td class="border border-slate-300 p-2">{{ m.cuerpo }}</td>
                                <td class="border border-slate-300 p-2">
                                    <a :href="route('messages.show', m.id)" class="text-blue-500 hover:underline">👁</a>
                                    <a :href="route('messages.edit', m.id)" class="text-green-500 hover:underline mx-2">📗</a>
                                    <form @submit.prevent="deleteMessage(m.id)" class="inline">
                                        <button type="submit" class="text-red-500 hover:underline">❌</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <p v-else class="text-center text-gray-500 dark:text-gray-400">No hay mensajes disponibles.</p>                   
                     
                </div>
            </div>
        </div>
    </AppLayout>
</template>