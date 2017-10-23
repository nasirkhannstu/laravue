<template>
<div class="">
    <div class="panel panel-default">
        <div class="panel-body">
            <input class="form-control feed-form" rows="3" v-model="name" placeholder="Product Name">
            <textarea class="form-control feed-form" rows="3" v-model="content" placeholder="Product Description"></textarea>
            <br>
            <div class="row">
                <div class="col-xs-3">
                    
                </div>
                <div class="col-xs-3">
                    <strong>Type</strong>
                </div>
                <div class="col-xs-3">
                    <strong>Price</strong>
                </div>
                <div class="col-xs-3">
                    <strong>Discount</strong>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-7">
                    <input type="file" v-on:change="onFileChange" id="file" class="inputfile">
                    <label for="file">Image</label>
                    <img :src="image" class="img-responsive">
                </div> 
                <div class="col-xs-5">
                    <button class="btn btn-success pull-right" :disabled="not_working" @click="create_post()">Publish</button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data(){
            return{
                content:'',
                not_working: true,
                image: ''
            }
        },
        props: ['page_id'],
        methods:{
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            create_post(){
                axios.post('/create/post', { 

                page_id: this.page_id,
                content: this.content,
                image: this.image

                }).then((resp)=>{
                    this.content = ''
                    this.image = ''
                    this.$store.commit('update_post',{
                        post:resp.data
                    })
                    new Noty({
                        type: 'success',
                        layout: 'bottomLeft',
                        text: 'Your post has published'
                    }).show();

                    console.log(resp)
                })
            }
        },
        watch:{
            content(){
                if(this.content.length > 0){
                    this.not_working = false
                }else{
                    this.not_working = true
                }
            }
        }
    }
</script>
<style scoped>
    .feed-form{
        border:none;
        resize: none;
        background:#ffffff;
    }
    img{
        max-height: 50px;
        border:2px;
    }
.inputfile {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    z-index: -1;
}
.inputfile + label {
}

.inputfile:focus + label,
.inputfile + label:hover {
    /*background-color: red;*/
}
.inputfile + label {
    cursor: pointer; /* "hand" cursor */
}
</style>