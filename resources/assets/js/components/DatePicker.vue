<template>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Pick a day" v-model="dateRange" readonly>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><font-awesome-icon icon="calendar-alt"/></button>
        </div>
    </div>
</template>

<script>
require("bootstrap-daterangepicker");
import "bootstrap-daterangepicker/daterangepicker.scss";
import fontawesome from '@fortawesome/fontawesome';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import faSpinner from '@fortawesome/fontawesome-free-solid/faSpinner';
import faCalendarAlt from '@fortawesome/fontawesome-free-solid/faCalendarAlt';

fontawesome.library.add(faSpinner, faCalendarAlt);
export default {
    components: {
        FontAwesomeIcon
    },
    props: {
        timePicker: {
            type: Boolean,
            default: false,
        },
        showRanges: {
            type: Boolean,
            default: false
        },
        startDate: {
            default: function () {
                return moment();
            }
        },
        endDate: {
            default: function () {
                return moment().add(1, 'days');
            }
        },
        minDate: {
            default: false
        },
        position: {
            default: 'left'
        },
        maxDate: {
            default: false
        },
        format: {
            type: String,
            default: function() {
                return this.format && this.timePicker ? this.format : "YYYY-MM-DD H:mm:ss"
            }
        },
        autoApply: {
            default: false
        },
    },
    data: function () {
        return {
            start: this.startDate,
            end: this.endDate
        };
    },
    computed: {
        dateRange: function () {
            var start = moment(this.start);
            var end = moment(this.end);
            var today = moment();

            if (this.timePicker && !this.format) {
                this.format = "YYYY-MM-DD H:mm:ss";
            }
            if (!this.showRanges) {
                if (today.format('LL') === start.format('LL')) return "Today";
                else return start.format(this.format);
            }
            else {
                if (
                    start.format('LL') === end.format('LL') &&
                    today.format('LL') === start.format('LL')
                ) {
                    return 'Today';
                } else if (start.format(this.format) === end.format(this.format)) {
                    return start.format(this.format);
                }
            }
            

            return start.format(this.format) + ' - ' + end.format(this.format);
        }
    },
    mounted: function () {
        var vm = this;
        this.start = moment(this.start);
        this.end = moment(this.end);
        this.$nextTick(() => {
            var options = {
                opens: this.position,
                startDate: this.start,
                endDate: this.end,
                autoApply: this.autoApply,
                alwaysShowCalendars: true,
                showDropdowns: true,
                parentEl: this.$el.parentElement
            };
            if (this.format) {
                options.format = this.format;
            }
            if (this.minDate) {
                options.minDate = this.minDate;
            }
            if (this.maxDate) {
                options.maxDate = this.maxDate;
            }

            if (this.showRanges) {
                options.ranges = {
                    Today: [moment(), moment()],
                    Yesterday: [
                        moment().subtract(1, 'days'),
                        moment().subtract(1, 'days')
                    ],
                    'Last 7 Days': [
                        moment().subtract(6, 'days'),
                        moment()
                    ],
                    'Last 30 Days': [
                        moment().subtract(30, 'days'),
                        moment()
                    ],
                    'This Month': [
                        moment().startOf('month'),
                        moment().endOf('month')
                    ],
                    'Last Month': [
                        moment().subtract(1, 'month').startOf('month'),
                        moment().subtract(1, 'month').endOf('month')
                    ]
                };
            } else {
                options.singleDatePicker = true;
            }

            if (this.timePicker) {
                options.timePicker = true;
                if (!this.format) this.format = "YYYY-MM-DD H:mm:ss";
            }

            window.$(this.$el)
                .daterangepicker(options)
                .on('apply.daterangepicker', (e, picker) => {
                    vm.$emit('apply', picker.startDate, picker.endDate);
                    vm.start = picker.startDate;
                    vm.end = picker.endDate;
                    if (!this.showRanges) {
                        vm.$emit('input', picker.startDate.format(this.format));
                    } else {
                        vm.$emit('input', {
                            startDate: picker.startDate.format(this.format),
                            endDate : picker.endDate.format(this.format)
                        });
                    }
                });
        });
    },
    watch: {

    }
}
</script>

<style scope>
    .daterangepicker {
        z-index: 100000;
    }
</style>
