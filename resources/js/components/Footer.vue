<template>
    <div class="footer">
        <div class="footer-text">
            © {{currentDate}} | Visos teisės saugomos
        </div>
    </div>
</template>
<script>
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
        border-top: 1px solid rgba(168, 86, 39, 0.5);
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