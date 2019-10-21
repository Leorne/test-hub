<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 py-3">
                <form>
                    <div class="card p-3 m-2">
                        <div class="form-group">
                            <label for="title">Test title</label>
                            <input name="title" type="text" class="form-control" id="title"
                                   placeholder="Enter test title" required>
                            <small id="emailHelp" class="form-text text-muted">This field is required.</small>
                        </div>
                        <div class="form-group">
                            <label for="about">About this test</label>
                            <textarea name="about" class="form-control" id="about" rows="6"
                                      placeholder="Here you can describe this test">
                            </textarea>
                        </div>
                        <div class="form-row text-center">
                            <div class="col-5 border p-0 ml-1 mr-auto">
                                <div class="custom-control custom-checkbox m-1">
                                    <input class="custom-control-input" type="checkbox" value="" id="detailInfo"
                                           required>
                                    <label class="custom-control-label" for="detailInfo">
                                        Test person can see the detailed result?
                                    </label>
                                </div>
                            </div>

                            <div class="col-5 border mr-1 ml-auto">
                                <div class="custom-control custom-checkbox m-1">
                                    <input class="custom-control-input" type="checkbox" value="" id="timerEnable"
                                           v-model="timerEnable" required>
                                    <label class="custom-control-label" for="timerEnable">
                                        Timer enable?
                                    </label>
                                </div>
                                <div class="form-check m-1" v-show="timerEnable">
                                    <label for="timer" class="form-check-label">Timer</label>
                                    <input type="time" name="timer" id="timer" step="2" v-model="timer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <new-question></new-question>

                    <div class="card text-center my-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Create test.">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

    import NewQuestion from './NewQuestion'
    export default {
        components: { NewQuestion },

        data() {
            return {
                timerEnable: false,
                timer: '00:30:00'
            }
        },
    }
</script>
