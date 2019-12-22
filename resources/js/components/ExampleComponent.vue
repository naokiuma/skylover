<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>


                    <div class="card-body">
                        I'm an example componentです.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
    export default {
            mounted() {
            console.log('Component mountedだ.');
        }

        /*
        props:['posts'],
        data:function(){
          return{
            category_id:[],
            selected: ''
            }
        },
        methods:{
        testFunc:function(){
        console.log("テストです"),
        console.log(this.selected)
          }
        },
        mounted() {
            console.log('Component mounted.'),
            //axios.get('/posts/gallery').then(response => this.posts),
            //console.log(this.posts)
        }
    }*/
    }
</script>
