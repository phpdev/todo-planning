<script setup>
import {ref} from "vue";

const data = ref(null);
const error = ref(null);

fetch('/planning-result')
    .then((res) => res.json())
    .then((json) => (data.value = json))
    .catch((err) => (error.value = err))
</script>

<template>
    <div class="container-fluid">

        <h1 class="mt-5 text-white text-center">To-Do Planning</h1>

        <div v-if="error">
            Request Failed
        </div>

        <div v-if="data" class="row">
            <div class="col" v-for="item in data">
                <div class="card mt-5 mb-5">
                    <div class="card-header">
                        <span class="fw-bold">{{ item.developer.name }} (Level: {{ item.developer.level }}) </span>
                        <span class="badge text-bg-secondary">{{ item.points }}p</span>
                    </div>
                    <div class="card-body">

                        <div class="card mt-2 mb-2" v-for="(weekInfo, weekIndex) in item.weekInfos">
                            <div class="card-header">
                                {{ weekIndex + 1 }}. Hafta
                                <span class="badge text-bg-secondary">{{ weekInfo.points }}p</span>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item" v-for="taskInfo in weekInfo.taskInfos">
                                    {{ taskInfo.task.name }}
                                    <span class="badge text-bg-secondary">{{ taskInfo.points }}p</span>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
body {
    background: #2DC44D;
}
</style>