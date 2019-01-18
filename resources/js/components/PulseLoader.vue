<template>
    <div :class="className" >
        <div class="v-spinner" v-show="loading">
            <div class="v-pulse v-pulse1" v-bind:style="[spinnerStyle,spinnerDelay1]">
            </div>
            <div class="v-pulse v-pulse2" v-bind:style="[spinnerStyle,spinnerDelay2]">
            </div>
            <div class="v-pulse v-pulse3" v-bind:style="[spinnerStyle,spinnerDelay3]">
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'PulseLoader',
    props: {
        loading: {
            type: Boolean,
            default: true
        },
        color: { 
            type: String,
            default: '#5dc596'
        },
        size: {
            type: String,
            default: '15px'
        },
        margin: {
            type: String,
            default: '2px'
        },
        radius: {
            type: String,
            default: '100%'
        },
        position: {
            type: String,
            default: 'absolute'
        }
    },
    computed: {
        className: function () {
            if (this.position == 'absolute') {
                return {
                    'abs-centered': true
                };
            }
            return {
                'position-relative': true
            };
        }
    },
    data () {
        return {
            spinnerStyle: {
                backgroundColor: this.color,
                width: this.size,
                height: this.size,
                margin: this.margin,
                borderRadius: this.radius,
                display: 'inline-block',
                animationName: 'v-pulseStretchDelay',
                animationDuration: '0.75s',
                animationIterationCount: 'infinite',
                animationTimingFunction: 'cubic-bezier(.2,.68,.18,1.08)',
                animationFillMode: 'both'
            },
            spinnerDelay1: {
                animationDelay: '0.12s'
            },
            spinnerDelay2: {
                animationDelay: '0.24s'
            },
            spinnerDelay3: {
                animationDelay: '0.36s'
            }
        }
    }
}
</script>

<style>
.abs-centered {
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
}

@-webkit-keyframes v-pulseStretchDelay
{
    0%,
    80%
    {
        -webkit-transform: scale(1);
                transform: scale(1);
        -webkit-opacity: 1;             
                opacity: 1;
    }
    45%
    {
        -webkit-transform: scale(0.1);
                transform: scale(0.1);
        -webkit-opacity: 0.7;             
                opacity: 0.7;
    }
}
@keyframes v-pulseStretchDelay
{
    0%,
    80%
    {
        -webkit-transform: scale(1);
                transform: scale(1);
        -webkit-opacity: 1;             
                opacity: 1;
    }
    45%
    {
        -webkit-transform: scale(0.1);
                transform: scale(0.1);
        -webkit-opacity: 0.7;             
                opacity: 0.7;
    }
}
</style>