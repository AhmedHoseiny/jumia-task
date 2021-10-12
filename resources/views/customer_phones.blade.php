<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Jumia - Phones</title>

    <!-- Importing from CDN just for test purpose -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
<div class="container-fluid">
    <h1>Phone Numbers</h1>

    <form method="GET" action="/customer/phones">
        <div class="row">
            <div class="col">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Select Country</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="country">
                            <option value="">Select...</option>
                            <option value="Morocco">Morroco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Cameroon">Cameroon</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Phone State</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="state">
                            <option value="">Select...</option>
                            <option value=1>Valid</option>
                            <option value=0>Invalid</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Country</th>
                <th scope="col">State</th>
                <th scope="col">Country code</th>
                <th scope="col">Phone number</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($result as $phone) : ?>
            <tr>
                <td><?= $phone['country'] ?></td>
                <td><?= $phone['state'] == true ? 'OK' : 'NOK' ?></td>
                <td><?= $phone['code'] ?></td>
                <td><?= $phone['number'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<!-- Importing from CDN just for test purpose -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
