<!DOCTYPE html>
<html>
    <head>
        <title>Laravel/Foundation</title>

        <link rel="stylesheet" type="text/css" href="{{ elixir('css/stylesheet.css') }}" />
    </head>
    <body>
        <div class="row">
            <div class="large-12 column">
                <ul class="accordion" data-accordion role="tablist">
                    <li class="accordion-item is-active">
                        <!-- The tab title needs role="tab", an href, a unique ID, and aria-controls. -->
                        <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d">Accordion 1</a>
                        <!-- The content pane needs an ID that matches the above href, role="tabpanel", data-tab-content, and aria-labelledby. -->
                        <div id="panel1d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel1d-heading">
                            Panel 1. Lorem ipsum dolor
                        </div>
                    </li>
                    <li class="accordion-item">
                        <!-- The tab title needs role="tab", an href, a unique ID, and aria-controls. -->
                        <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d">Accordion 1</a>
                        <!-- The content pane needs an ID that matches the above href, role="tabpanel", data-tab-content, and aria-labelledby. -->
                        <div id="panel1d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel1d-heading">
                            Panel 2. Lorem ipsum dolor
                        </div>
                    </li>
                    <li class="accordion-item">
                        <!-- The tab title needs role="tab", an href, a unique ID, and aria-controls. -->
                        <a href="#panel1d" role="tab" class="accordion-title" id="panel1d-heading" aria-controls="panel1d">Accordion 1</a>
                        <!-- The content pane needs an ID that matches the above href, role="tabpanel", data-tab-content, and aria-labelledby. -->
                        <div id="panel1d" class="accordion-content" role="tabpanel" data-tab-content aria-labelledby="panel1d-heading">
                            Panel 3. Lorem ipsum dolor
                        </div>
                    </li>
                </ul>            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <ul class="vertical menu" data-accordion-menu>
                    <li>
                        <a href="#">Item 1</a>
                        <ul class="menu vertical nested is-active">
                            <li>
                                <a href="#">Item 1A</a>
                                <ul class="menu vertical nested">
                                    <li><a href="#">Item 1Ai</a></li>
                                    <li><a href="#">Item 1Aii</a></li>
                                    <li><a href="#">Item 1Aiii</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Item 1B</a></li>
                            <li><a href="#">Item 1C</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Item 2</a>
                        <ul class="menu vertical nested">
                            <li><a href="#">Item 2A</a></li>
                            <li><a href="#">Item 2B</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Item 3</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <span class="secondary badge">2</span>
                <span class="success badge">3</span>
                <span class="alert badge">A</span>
                <span class="warning badge">B</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <nav aria-label="You are here:" role="navigation">
                    <ul class="breadcrumbs">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Features</a></li>
                        <li class="disabled">Gene Splicing</li>
                        <li><span class="show-for-sr">Current: </span> Cloning</li>
                    </ul>
                </nav>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <a href="#" class="button">Learn More</a>
                <a href="#features" class="button">View All Features</a>

                <button type="button" class="success button">Save</button>
                <button type="button" class="alert button">Delete</button>

                <a class="tiny button" href="#">So Tiny</a>
                <a class="small button" href="#">So Small</a>
                <a class="large button" href="#">So Large</a>
                <a class="expanded button" href="#">Such Expand</a>

                <div class="button-group">
                    <a class="button">One</a>
                    <a class="button">Two</a>
                    <a class="button">Three</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <div class="callout">
                    <h5>This is a callout.</h5>
                    <p>It has an easy to override visual style, and is appropriately subdued.</p>
                    <a href="#">It's dangerous to go alone, take this.</a>
                </div>
                <div class="callout secondary">
                    <h5>This is a secondary callout</h5>
                    <p>It has an easy to override visual style, and is appropriately subdued.</p>
                    <a href="#">It's dangerous to go alone, take this.</a>
                </div>
                <div class="callout success">
                    <h5>This is a success callout</h5>
                    <p>It has an easy to override visual style, and is appropriately subdued.</p>
                    <a href="#">It's dangerous to go alone, take this.</a>
                </div>
                <div class="callout warning">
                    <h5>This is a warning callout</h5>
                    <p>It has an easy to override visual style, and is appropriately subdued.</p>
                    <a href="#">It's dangerous to go alone, take this.</a>
                </div>
                <div class="callout alert">
                    <h5>This is an alert callout</h5>
                    <p>It has an easy to override visual style, and is appropriately subdued.</p>
                    <a href="#">It's dangerous to go alone, take this.</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <div class="callout" data-closable data-alert>
                    <p>You can so totally close this!</p>
                    <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <ul class="vertical menu" data-drilldown style="width: 200px" id="m1">
                    <li>
                        <a href="#">Item 1</a>
                        <ul class="vertical menu" id="m2">
                            <li>
                                <a href="#">Item 1A</a>
                                <ul class="vertical menu" id="m3">
                                    <li><a href="#">Item 1Aa</a></li>
                                    <li><a href="#">Item 1Ba</a></li>
                                    <li><a href="#">Item 1Ca</a></li>
                                    <li><a href="#">Item 1Da</a></li>
                                    <li><a href="#">Item 1Ea</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Item 1B</a></li>
                            <li><a href="#">Item 1C</a></li>
                            <li><a href="#">Item 1D</a></li>
                            <li><a href="#">Item 1E</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Item 2</a>
                        <ul class="vertical menu">
                            <li><a href="#">Item 2A</a></li>
                            <li><a href="#">Item 2B</a></li>
                            <li><a href="#">Item 2C</a></li>
                            <li><a href="#">Item 2D</a></li>
                            <li><a href="#">Item 2E</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Item 3</a>
                        <ul class="vertical menu">
                            <li><a href="#">Item 3A</a></li>
                            <li><a href="#">Item 3B</a></li>
                            <li><a href="#">Item 3C</a></li>
                            <li><a href="#">Item 3D</a></li>
                            <li><a href="#">Item 3E</a></li>
                        </ul>
                    </li>
                    <li><a href='#'> Item 4</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <ul class="dropdown menu" data-dropdown-menu>
                    <li>
                        <a>Item 1</a>
                        <ul class="menu">
                            <li><a href="#">Item 1A Loooong</a></li>
                            <li>
                                <a href='#'> Item 1 sub</a>
                                <ul class='menu'>
                                    <li><a href='#'>Item 1 subA</a></li>
                                    <li><a href='#'>Item 1 subB</a></li>
                                    <li>
                                        <a href='#'> Item 1 sub</a>
                                        <ul class='menu'>
                                            <li><a href='#'>Item 1 subA</a></li>
                                            <li><a href='#'>Item 1 subB</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href='#'> Item 1 sub</a>
                                        <ul class='menu'>
                                            <li><a href='#'>Item 1 subA</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#">Item 1B</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Item 2</a>
                        <ul class="menu">
                            <li><a href="#">Item 2A</a></li>
                            <li><a href="#">Item 2B</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Item 3</a></li>
                    <li><a href='#'>Item 4</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <button class="button" type="button" data-toggle="example-dropdown">Toggle Dropdown</button>
                <div class="dropdown-pane" id="example-dropdown" data-dropdown>
                    Just some junk that needs to be said. Or not. Your choice.
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <div class="callout clearfix">
                    <a class="button float-left">Left</a>
                    <a class="button float-right">Right</a>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <form>
                    <label>Input Label
                        <input type="text" placeholder=".small-12.columns" aria-describedby="exampleHelpText">
                    </label>
                    <p class="help-text" id="exampleHelpText">Here's how you use this input field!</p>
                    <label>
                        How many puppies?
                        <input type="number" value="100">
                    </label>
                    <label>
                        What books did you read over summer break?
                        <textarea placeholder="None"></textarea>
                    </label>
                    <label>Select Menu
                        <select>
                            <option value="husker">Husker</option>
                            <option value="starbuck">Starbuck</option>
                            <option value="hotdog">Hot Dog</option>
                            <option value="apollo">Apollo</option>
                        </select>
                    </label>
                    <div class="row">
                        <fieldset class="large-6 columns">
                            <legend>Choose Your Favorite</legend>
                            <input type="radio" name="pokemon" value="Red" id="pokemonRed" required><label for="pokemonRed">Red</label>
                            <input type="radio" name="pokemon" value="Blue" id="pokemonBlue"><label for="pokemonBlue">Blue</label>
                            <input type="radio" name="pokemon" value="Yellow" id="pokemonYellow"><label for="pokemonYellow">Yellow</label>
                        </fieldset>
                        <fieldset class="large-6 columns">
                            <legend>Check these out</legend>
                            <input id="checkbox1" type="checkbox"><label for="checkbox1">Checkbox 1</label>
                            <input id="checkbox2" type="checkbox"><label for="checkbox2">Checkbox 2</label>
                            <input id="checkbox3" type="checkbox"><label for="checkbox3">Checkbox 3</label>
                        </fieldset>
                    </div>
                    <div class="row">
                        <div class="small-3 columns">
                            <label for="middle-label" class="right middle">Label</label>
                        </div>
                        <div class="small-9 columns">
                            <input type="text" id="middle-label" placeholder="Right- and middle-aligned text input">
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-label">$</span>
                        <input class="input-group-field" type="url">
                        <a class="input-group-button button">Submit</a>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <span class="secondary label">Secondary Label</span>
                <span class="success label">Success Label</span>
                <span class="alert label">Alert Label</span>
                <span class="warning label">Warning Label</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <ul class="menu">
                    <li><a href="#">One</a></li>
                    <li><a href="#">Two</a></li>
                    <li><a href="#">Three</a></li>
                    <li><a href="#">Four</a></li>
                </ul>
                <ul class="menu icon-top">
                    <li><a href="#"><i class="fi-list"></i> <span>One</span></a></li>
                    <li><a href="#"><i class="fi-list"></i> <span>Two</span></a></li>
                    <li><a href="#"><i class="fi-list"></i> <span>Three</span></a></li>
                    <li><a href="#"><i class="fi-list"></i> <span>Four</span></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <ul class="pagination" role="navigation" aria-label="Pagination">
                    <li class="disabled">Previous <span class="show-for-sr">page</span></li>
                    <li class="current"><span class="show-for-sr">You're on page</span> 1</li>
                    <li><a href="#" aria-label="Page 2">2</a></li>
                    <li><a href="#" aria-label="Page 3">3</a></li>
                    <li><a href="#" aria-label="Page 4">4</a></li>
                    <li class="ellipsis" aria-hidden="true"></li>
                    <li><a href="#" aria-label="Page 12">12</a></li>
                    <li><a href="#" aria-label="Page 13">13</a></li>
                    <li><a href="#" aria-label="Next page">Next <span class="show-for-sr">page</span></a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="large-12 column">
                <i class="fi-heart"></i>
                <i class="fi-home"></i>
                <i class="fi-x"></i>
                <i class="fi-page-filled"></i>
                <i class="fi-page-multiple"></i>
                <i class="fi-arrow-up"></i>
                <i class="fi-arrow-down"></i>
                <i class="fi-arrow-left"></i>
                <i class="fi-arrow-right"></i>
                <i class="fi-torso"></i>
                <i class="fi-torsos"></i>
                <i class="fi-torsos-all"></i>
                <i class="fi-save"></i>
                <i class="fi-play"></i>
                <i class="fi-stop"></i>
                <i class="fi-pause"></i>
                <i class="fi-info"></i>
                <i class="fi-clipboard"></i>
            </div>
        </div>
        <script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
        <script type="text/javascript">
            $(document).foundation();
        </script>
    </body>
</html>
