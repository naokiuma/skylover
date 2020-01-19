<template>
    <div class="c-category__wrapper">
            <div class="c-category__btn-wrapper">

                <section class="c-category__btn">
                    <h2 class="choice" v-on:click="show_morning">Morning</h2>
                </section>

                <section class="c-category__btn">
                    <h2 class="choice" v-on:click="show_daytime">Daytime</h2>
                </section>

                <section class="c-category__btn">
                    <h2 class="choice" v-on:click="show_night">Night</h2>
                </section>
            </div>

            <div class="space"></div>

            <section class="c-category__posts">

                <div class="c-category__morning" v-show="morning_pic">
                    <div v-for="(morning_post,index) in morning_posts" :key="index">
                        <div class="c-category__header">    
                            <h4>{{ morning_post.title }}</h4>
                            <p>{{ morning_post.content }}</p>
                            <a :href="morning_post.id" target="_blank"><img :src="morning_post.image_url | replace('public','..storage')" alt=""></a>
                        </div>                        
                    </div>
                </div>

                <div class="c-category__daytime" v-show="daytime_pic">
                    <ul v-for="(daytime_post,index) in daytime_posts" :key="index" class="c-card">
                        <li class="c-category__header">
                            <h4>{{ daytime_post.title }}</h4>
                            <p>{{ daytime_post.content}}</p>
                            <a :href="daytime_post.id" target="_blank"><img :src="daytime_post.image_url | replace('public','..storage')" alt=""></a>
                        </li>
                        
                    </ul>                   
                </div>

                <div class="c-category__night" v-show="night_pic">
                    <ul v-for="(night_post,index) in night_posts" :key="index" class="c-card">
                        <li class="c-category__header">
                            <h4>{{ night_post.title }}</h4>
                            <p>{{ night_post.content}}</p>
                            <a :href="night_post.id" target="_blank"><img :src="night_post.image_url | replace('public','..storage')" alt=""></a>
                        </li>
                    </ul>
                </div>
            </section>

        </div>
</template>

<script>
    export default {
        props:['morning','daytime','night'],
        data:function(){
            return{
                morning_posts:this.morning, 
                daytime_posts:this.daytime,
                night_posts:this.night,
                morning_pic:true,
                daytime_pic:false,
                night_pic:false
            }
        },
        mounted(){
           // console.log("朝です");
            console.log(this.morning_posts);
        },
        
        filters:{ //カスタムフィルタ
            replace:function(val){
                return val.replace("public", "../storage");   

            }
        },
        
        methods:{
            show_morning:function(){
                this.morning_pic = true;
                this.daytime_pic = false;
                this.night_pic = false;
            },
            show_daytime:function(){
                this.morning_pic = false;
                this.daytime_pic = true;
                this.night_pic = false;
            },
            show_night:function(){
                this.morning_pic = false;
                this.daytime_pic = false;
                this.night_pic = true;
            }
        }

    }
</script>
