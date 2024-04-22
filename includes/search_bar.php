<!-- includes/search_bar.php -->

<div class="container-fluid my-2">
    <form action="/web-programming-assignment/search" method="get">
        <div class="input-group input-group">
            <div class="input-group-prepend mr-2">
                <select class="custom-select rounded" name="city">
                    <option selected>All cities</option>
                    <option value="hcm">Ho Chi Minh City</option>
                    <option value="dn">Da Nang</option>
                    <option value="hn">Ha Noi</option>
                </select>
            </div>
            <input type="text" class="form-control rounded mr-2" placeholder="Search with keywords, title, company..." name="q">
            <div class="input-group-append">
                <!-- submit button in a tag and style hiredcmut-button -->
                <button type="submit" class="hiredcmut-button-light">Search</button>
            </div>
        </div>
    </form>
</div>