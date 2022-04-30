<template>
    <div class="footer">
        <div class="footer-text">
            © {{currentDate}} | Visos teisės saugomos
        </div>
    </div>
</template>
<script>
import { computed } from '@vue/runtime-core'
export default {
    data () {
        return {
        }
    },
    computed: {
        currentDate () {
            return new Date().getFullYear()
        }
    }
}
</script>
<style>
    .footer {
        border-top: 1px solid #a85727;
        background-color: #fff;
        height: 40px;
        color: #a85727;
        text-align: center;
        width: 100%;
    }
    .footer-text {
        padding: 1em;
        font-family: 'Open Sans', sans-serif;
        font-weight: 300;
        font-size: 12px;
        letter-spacing: -0.02em;
    }
</style>