@extends('backend.'.config('website.backend').'.layouts.app')

@section('content')

<div class="row">
    <form id="form" class="form-horizontal form-bordered" method="get">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Input Text</h2>
            </header>
            <div class="panel-body" id="collapseOne">
                <div class="col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault">Text</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" required id="inputDefault">
                        </div>

                        <label class="col-md-2 control-label" for="inputDefault">Grouping</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon ">.00</span>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">

                        <label class="col-md-2 control-label" for="inputSuccess">Radio</label>
                        <div class="col-md-4">
                            <div class="radio-custom radio-primary radio-inline">
                                <input type="radio" id="radioExample5" name="radioExample">
                                <label for="radioExample5">Radio1</label>
                            </div>

                            <div class="radio-custom radio-danger radio-inline">
                                <input type="radio" id="radioExample5" name="radioExample">
                                <label for="radioExample5">Radio2</label>
                            </div>

                            <div class="radio-custom radio-danger radio-inline">
                                <input type="radio" disabled="" checked="" id="radioExample5" name="radioExample">
                                <label for="radioExample5">Radio3</label>
                            </div>

                        </div>

                        <label class="col-md-2 control-label" for="inputSuccess">Checkbox</label>
                        <div class="col-md-4">
                            <div class="checkbox-custom checkbox-primary checkbox-inline">
                                <input type="checkbox" checked="" id="checkboxExample2">
                                <label for="checkboxExample2">Checkbox Primary</label>
                            </div>
                            <div class="checkbox-custom checkbox-inline">
                                <input type="checkbox" checked="" id="checkboxExample2">
                                <label for="checkboxExample2">Checkbox Primary</label>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-md-2 control-label" for="inputSuccess">Date</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>

                        <label class="col-md-2 control-label" for="inputSuccess">Phone</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input id="phone" data-plugin-masked-input data-input-mask="(999) 999-9999" placeholder="(123) 123-1234" class="form-control">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">

                        <label class="col-md-2 control-label" for="inputSuccess">Tag</label>
                        <div class="col-md-4">
                            <select class="form" id="tags-input-multiple" multiple data-role="tagsinput" data-tag-class="label label-primary">
                                <option value="Amsterdam">Amsterdam</option>
                                <option value="Washington">Washington</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label" for="inputSuccess">RGBA</label>
                        <div class="col-md-4">

                            <div class="input-group color" data-color="" data-color-format="rgb" data-plugin-colorpicker>
                                <span class="input-group-addon"><i></i></span>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-2 control-label" for="textareaDefault">Textarea</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="3" id="textareaDefault"></textarea>
                        </div>

                        <label class="col-md-2 control-label" for="textareaDefault">LimitText</label>
                        <div class="col-md-4">
                            <textarea class="form-control" rows="2" data-plugin-maxlength maxlength="140"></textarea>
                            <p>
                                <code>max-length</code> set to 140.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Select Option</h2>
            </header>
            <div class="panel-body" id="collapseTwo">
                <div class="col-md-12 col-lg-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault">Option</label>
                        <div class="col-md-4">
                            <select class="form-control mb-md">
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>

                        <label class="col-md-2 control-label" for="inputDefault">OptionText</label>
                        <div class="col-md-4">
                            <select data-plugin-selectTwo class="form-control populate" data-plugin-options='{ "minimumInputLength": 2 }'>
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault">Option Select All</label>
                        <div class="col-md-4">
                            <div class="btn-group" id="select-button">
                                <select class="form-control" multiple="multiple" data-plugin-multiselect data-multiselect-toggle-all="true" id="ms_example7">
                                    <option value="cheese">Cheese</option>
                                    <option value="tomatoes">Tomatoes</option>
                                    <option value="mozarella">Mozzarella</option>
                                    <option value="mushrooms">Mushrooms</option>
                                    <option value="pepperoni">Pepperoni</option>
                                    <option value="onions">Onions</option>
                                </select>
                                <button id="ms_example7-toggle" class="btn btn-primary">Select All</button>
                            </div>
                            <div class="switch switch-sm switch-primary pull-right">
                                <input type="checkbox" name="switch" data-plugin-ios-switch checked="checked" />
                            </div>
                        </div>

                        <label class="col-md-2 control-label" for="inputDefault">OptionMultiple</label>
                        <div class="col-md-4">
                            <select multiple data-plugin-selectTwo class="form-control populate">
                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </optgroup>
                                <optgroup label="Pacific Time Zone">
                                    <option value="CA">California</option>
                                    <option value="NV">Nevada</option>
                                    <option value="OR">Oregon</option>
                                    <option value="WA">Washington</option>
                                </optgroup>
                                <optgroup label="Mountain Time Zone">
                                    <option value="AZ">Arizona</option>
                                    <option value="CO">Colorado</option>
                                    <option value="ID">Idaho</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="UT">Utah</option>
                                    <option value="WY">Wyoming</option>
                                </optgroup>
                                <optgroup label="Central Time Zone">
                                    <option value="AL">Alabama</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TX">Texas</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="WI">Wisconsin</option>
                                </optgroup>
                                <optgroup label="Eastern Time Zone">
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="IN">Indiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="OH">Ohio</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WV">West Virginia</option>
                                </optgroup>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>

                <h2 class="panel-title">Input Date</h2>
            </header>
            <div class="panel-body" id="collapseTwo">
                <div class="col-md-12 col-lg-12">
                    <div class="form-group">

                        <label class="col-md-2 control-label" for="inputDefault">Datepicker</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" data-plugin-datepicker class="form-control">
                            </div>
                        </div>

                        <label class="col-md-2 control-label" for="inputDefault">Timepicker</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </span>
                                <input type="text" data-plugin-timepicker class="form-control" data-plugin-options='{ "showMeridian": false }'>
                            </div>
                        </div>

                        
                    </div>

                    <div class="form-group">

                        <label class="col-md-2 control-label" for="inputDefault">DateRange</label>
                        <div class="col-md-4">
                            <div class="input-daterange input-group" data-plugin-datepicker>
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input type="text" class="form-control" name="start">
                                <span class="input-group-addon">to</span>
                                <input type="text" class="form-control" name="end">
                            </div>
                        </div>

                        <label class="col-md-2 control-label" for="inputDefault">Spinner</label>
                        <div class="col-md-4">
                            <div class="m-md slider-primary" data-plugin-slider data-plugin-options='{ "values": [ 25, 75 ], "range": true, "max": 100 }' data-plugin-slider-output="#listenSlider2">
                                <input id="listenSlider2" type="hidden" value="25, 75" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-9 col-sm-offset-3">
                    <div class="btn-group pull-right">
                        <button type="reset" class="btn btn-default">Reset</button>
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>
                </div>
            </div>
        </footer>

    </form
</div>

@endsection
