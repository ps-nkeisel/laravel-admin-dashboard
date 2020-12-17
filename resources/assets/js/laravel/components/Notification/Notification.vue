<template>
    <a class="text-dark media py-2" :href="'/notifications/' + notification.id">
        <div class="mx-3">
            <i class="fa fa-fw fa-check-circle text-success"></i>
        </div>
        <div class="media-body font-size-sm pr-2">
            <div class="font-w600">{{ notification.message }}</div>
            <div class="text-muted font-italic">{{ notification.created_at }}</div>
        </div>
    </a>
</template>

<script>
    export default {
        props: {
            notification: Object
        },
    }
</script>
