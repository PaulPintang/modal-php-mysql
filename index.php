<?php

        $db = mysqli_connect('localhost', 'root', '', 'modal');
        $data = mysqli_query($db, "SELECT * FROM data");

        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $rec = mysqli_query($db, "SELECT * FROM data WHERE id=$id");
            $details = mysqli_fetch_array($rec);
            $name = $details['name'];
            $id = $details['id'];
        }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen items-center justify-center">
               <div class="bg-white rounded-lg p-6 shadow-sm" style="width: 500px">
                <div class="flex justify-between pb-5">
                    <h1 class="font-medium text-gray-700">Users</h1>
                    <div>
                        <a href="#" onclick="toggleModal('user_modal')" class="hidden">
                          <i class="fas fa-plus text-gray-400"></i>
                        </a>
                    </div>
                </div>
                 <table class="min-w-full divide-y divide-gray-200">
                    <thead class="">
                        <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Name
                        </th>
                        <th scope="col" class="relative px-3 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                        </tr>
                    </thead>
                   <tbody class="bg-white divide-y divide-gray-200">
                    <?php while ($row = mysqli_fetch_array($data)) { ?>
                        <tr>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <div class="ml-4">
                                    <small><?php echo $row['name']?></small>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right font-medium" style="font-size: 13px">
                                <button onclick="userModal('user_modal')" class="cursor-pointer">
                                     <a href="?edit=<?php echo $row['id']?>" class="text-indigo-600 hover:text-indigo-900 w-full transition-all">Edit</a>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>


            <!-- modal -->
            <div class=" flex hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center" id="user_modal">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <!-- <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>s -->
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all">
                        <div class="bg-white p-5 mx-5 my-5" style="max-width: 500px">
                            <div class="flex justify-between items-center pb-8">
                                <h1 class="font-semibold text-gray-600 text-xl">Add new event</h1>
                                <i class="fas fa-close text-gray-300 cursor-pointer" onclick="userModal('user_modal')"></i>
                            </div>
                            <form action="./modals/user_modal_process.php" method="post" class="space-y-2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <div class="space-y-2">
                                    <p class="text-sm">Name <span class="text-red-500">*</span></p>
                                    <input type="text" value="<?php echo $name; ?>" autocomplete="off" name="name" class="bg-gray-100 focus:outline-none border-none focus:bg-gray-200 rounded py-2 px-2 text-gray-500 w-full">
                                </div>
                                <div class="flex justify-center">
                                    <div style="font-size: 14px">
                                        <button type="button" onclick="userModal('user_modal')" class="px-6 py-2 bg-gray-100 rounded text-gray-500">
                                            Cancel
                                        </button>
                                        <button class="px-6 bg-green-500 hover:bg-green-400 py-2 text-white rounded ml-3" name="update" type="submit" onclick="toggleModal('modal-id')">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

       <script type="text/javascript">
        function userModal(modalID){
            document.getElementById(modalID).classList.toggle("hidden");
            document.getElementById(modalID + "-backdrop").classList.toggle("hidden");
            document.getElementById(modalID).classList.toggle("flex");
            document.getElementById(modalID + "-backdrop").classList.toggle("flex");
        }
   </script>
</body>
</html>