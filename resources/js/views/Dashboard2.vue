<template>
    <div class="dashboard2">
        <h2>
            Manager dashboard
        </h2>
        <pdf-generation></pdf-generation>
    </div>
</template>
<script>
import PdfGeneration from '../components/PdfGeneration.vue'
export default {
    components: {
        PdfGeneration
    },
    data() {
        return {
        }
    },
    created(){
    },
    methods: {
    }
}
</script>
<style>
    .dashboard2 {
        padding: 53px 1vw 0 1vw;
    }
</style>
