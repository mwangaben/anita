<template>
    <div class="master">
        <span style="padding-top: 2em" class="rain-bow"></span>
        <ul></ul>
    </div>
</template>
<script>
export default {
    props: {
        message: {
        	type : String,
            required: true,
            validator: message => message.length > 1,

        },
        author: {
            type: String,
            default: 'MwangaB'
        },

    }

}
</script>
