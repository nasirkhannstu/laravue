<template>
<div class="">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-7">
                    <input class="form-control feed-form" rows="3" v-model="name" placeholder="Product Name">
                </div>
                <div class="col-xs-5">
                    <select v-model="type" class="form-control">
                        <option disabled value="">Type</option>
                        <option value="product">Product</option>
                        <option value="product">Offer</option>
                        <option value="product">Speech</option>
                    </select>
                </div>
            </div>
            <textarea class="form-control feed-form" rows="3" v-model="content" placeholder="Product Description"></textarea>
            <br>
            <div class="row">
                <div class="col-xs-4">
                    <input class="form-control feed-form" rows="3" v-model="price" placeholder="Price">
                </div>
                <div class="col-xs-4">
                    <input class="form-control feed-form" rows="3" v-model="qty" placeholder="Quantity">
                </div>
                <div class="col-xs-4">
                    <input class="form-control feed-form" rows="3" v-model="discount" placeholder="Discount(%)" @blur="discount()">
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
                name:'',
                content:'',
                type:'',
                price:'',
                qty:'',
                discount:'',
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
                name: this.name,
                type: this.type,
                price: this.price,
                qty: this.qty,
                discount: this.discount,
                content: this.content,
                image: this.image

                }).then((resp)=>{
                    this.content = ''
                    this.image = ''
                    this.name = ''
                    this.type = ''
                    this.price = ''
                    this.qty = ''
                    this.discount = ''
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
            },
            discount(){
                
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
        border-bottom: 1px solid #f1f1f1;
        resize: none;
        background:#ffffff;
    }
    select{
        border:none;
        border-bottom: 1px solid #f1f1f1;
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