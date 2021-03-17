<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="../static/css/crud.css">
    <title>Minimvc - crud</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">MiniMVC</a>
        </div>

    </nav>
    <div class="container w-100 mt-5">
        <div class="text-end">
            <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</div>
        </div>
        <div class="mt-5">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($context as $key => $contact):?>

                    <tr>
                        <th scope="row"><?= $key + 1;?></th>
                        <td><?= $contact['name']; ?></td>
                        <td><?= $contact['phone']; ?></td>
                        <td>
                            <span href="#" class="badge bg-success" data-bs-toggle="modal"
                                data-bs-target="#modal<?= $contact['phone'];?>">Update</span>
                            <span href="#" class="badge bg-danger"
                                onclick="delData(<?= $contact['id']; ?>)">Delete</span>
                        </td>
                    </tr>
                    <div class="modal fade" id="modal<?= $contact['phone'];?>" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Update Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form method="POST" action="crud/update">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input name="id" type="hidden" class="form-control"
                                                value="<?= $contact['id'];?>">
                                            <input name="nama" type="text" class="form-control"
                                                value="<?= $contact['name'];?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">No Hp</label>
                                            <input name="phone" type="text" class="form-control"
                                                value="<?= $contact['phone'];?>" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">No Hp</label>
                            <input name="phone" type="text" class="form-control" id="phone" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php if(isset($_SESSION['flash'])):?>

    <script>
    Swal.fire({
        title: "<?= $_SESSION['flash']['title'] ;?>",
        text: "<?= $_SESSION['flash']['text'] ;?>",
        icon: "<?= $_SESSION['flash']['icon'] ;?>"
    })
    </script>
    <?php 
        $_SESSION['flash'] = null;
    ?>
    <?php endif;?>
    <script>
    const delData = async (key) => {
        let cf = await Swal.fire({
            title: "Delete Data",
            text: "Are you sure want to delete this?",
            icon: "question",
            showCancelButton: true
        });
        if (cf.isConfirmed) {
            fetch('crud/delete', {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        id: key
                    })
                }).then(response => response.json())
                .then(res => {
                    if (res.code == 200) {
                        Swal.fire({
                            title: 'Success',
                            text: 'Success deleting data',
                            icon: 'success',
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                        setTimeout(() => {
                            window.location.reload()
                        }, 1500)
                    }
                })
        }
    }
    </script>
</body>

</html>