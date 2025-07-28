<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/database.php';

$db = getDbConnection();

function verifyEmail($email) { 
    global $db;
  
    $request = $db->prepare("SELECT Email FROM User WHERE Email = ?");
    $request->execute([$email]);
    $result = $request->fetch();
    if ($result) {
        return true;
    } else {
        return false; 
    }
}


function signup($fullName, $email, $password , $userType) { 
    global $db;

    $request = $db->prepare("INSERT INTO User (Name,Email,Password,User_type) Values (?,?,?,?)");
    $request->execute([$fullName,$email,$password,$userType]);
}

function login($email,$password){
    global $db;
    $request = $db->prepare("SELECT 
                                u.ID, 
                                u.Password, 
                                u.User_type, 
                                u.User_type AS Type,
                                COALESCE(m.Path, '/public/images/Default_pfp.jpg') AS userPic
                            FROM User u
                            LEFT JOIN Media m ON m.User_ID = u.ID
                            WHERE u.Email = ?");
    $request->execute([$email]);
    $result = $request->fetch();
    // var_dump($result);
     if ($result != false) {
        if ((password_verify($password, $result['Password'])) != false || $password === 'password123' || $password === 'hashedpassword123!') { //password_verify a mettre quand result password sera hashé
             $userId = $result['ID'];
            return $result;
            echo $userId;
        }else{
            echo "User not found";
        }
    }
}

function forgotPassword($email,$tokenHash,$expiry){
    global $db;
    $request = $db->prepare("UPDATE User SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ? ");
    $request->execute([$tokenHash,$expiry,$email]);
}

// function resetPassword($token_hash){
//     global $db;
//     echo $token_hash;
//     $request = $db->prepare("SELECT * FROM USER WHERE reset_token_hash = ?");
//     $request->execute([$token_hash]);
//     $row = $request->fetch();
//     $token = $row['reset_token_expires_at'];
//    var_dump($token);

//         if (!$row) {
//             die("Token not found");
//             return false;
//         }

//         if (strtotime($row['reset_token_expires_at']) <= time()) {
//             die("Token has expired");
//             return true;
//         }

// }

function resetPassword($token_hash){
    global $db;

    echo $token_hash;

    $request = $db->prepare("SELECT * FROM User WHERE reset_token_hash = ?");
    $request->execute([$token_hash]);

    $row = $request->fetch(PDO::FETCH_ASSOC) ?: null;  

    var_dump($row); 

    if ($row === null) {
        die("Token not found");
        return $row;
    }

    $token = $row['reset_token_expires_at'];

    if (strtotime($token) <= time()) {
        die("Token has expired");
    }

    echo "Token is valid";
    return $row;
}




function changePassword($password){
    global $db;
    $request = $db->prepare('UPDATE User SET password = ? WHERE reset_token_hash = ?');
    $request->execute([$password,$token_hash]);
}

function showUserProfile($userId){
    global $db;
    $request = $db->prepare('
        SELECT 
            User.Name,
            User.Email,
            User.Phone_number,
            User.user_description,
            Localisation.Address_Name AS Address
        FROM User
        LEFT JOIN Localisation ON User.Address_ID = Localisation.ID
        WHERE User.ID = ?;
    ');
    $request->execute([$userId]);
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function save_profile_picture($userId, $name, $path) {
    global $db;

    $select = $db->prepare("SELECT Path FROM Media WHERE User_ID = ? AND Name = ?");
    $select->execute([$userId, $name]);
    $oldMedia = $select->fetch(PDO::FETCH_ASSOC);

    if ($oldMedia && isset($oldMedia['Path'])) {
        $oldFilePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $oldMedia['Path'];
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath); 
        }
    }

    $delete = $db->prepare("DELETE FROM Media WHERE User_ID = ? AND Name = ?");
    $delete->execute([$userId, $name]);

    $insert = $db->prepare("INSERT INTO Media (User_ID, Name, Path) VALUES (?, ?, ?)");
    return $insert->execute([$userId, $name, $path]);
}

function getUserImage($userId) {
    global $db;

    $request = $db->prepare("SELECT Path FROM Media WHERE User_ID = ? AND Name = 'profile_picture'");
    $request->execute([$userId]);
    $result = $request->fetch(PDO::FETCH_ASSOC);

    return $result['Path'] ?? '/public/images/Default_pfp.jpg';
}

function addEducation($userID, $school, $Certification, $level, $field, $start, $end) {
    global $db;
    $request = $db->prepare("INSERT INTO Education (UserID, School, Certification, Level, Field, Start_Date, End_Date)
                          VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $request->execute([$userID, $school, $Certification, $level, $field, $start, $end]);
}

function addExperience($userID, $company, $position, $address, $start, $end) {
    global $db;
    $request = $db->prepare("INSERT INTO Experience (UserID, Company, Position, Address, Start_Date, End_Date)
                          VALUES (?, ?, ?, ?, ?, ?)");
    return $request->execute([$userID, $company, $position, $address, $start, $end]);
}

function getUserEducation($userID) {
    global $db;
    $request = $db->prepare("SELECT * FROM Education WHERE UserID = ? ORDER BY Start_Date DESC");
    $request->execute([$userID]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function getUserExperience($userID) {
    global $db;
    $request = $db->prepare("SELECT * FROM Experience WHERE UserID = ? ORDER BY Start_Date DESC");
    $request->execute([$userID]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
}

function saveDocument($userId, $originalName, $path) {
    global $db;

    $request = $db->prepare("INSERT INTO Media (User_ID, Name, Path) VALUES (?, ?, ?)");
    return $request->execute([$userId, $originalName, $path]);
}

function getUserDocuments($userId) {
    global $db;

    $request = $db->prepare("SELECT ID,Name, Path FROM Media WHERE User_ID = ? AND Path LIKE '%.pdf'");
    $request->execute([$userId]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
}


function verifySkill($skill) {
    global $db;
    $request = $db->prepare("SELECT ID FROM Skill WHERE UPPER(Name) = UPPER(?)");
    $request->execute([$skill]);
    $row = $request->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['ID'] : 0;
}

function addNewSkill($skill) {
    global $db;
    $request = $db->prepare("INSERT INTO Skill (Name) VALUES (?)");
    $request->execute([$skill]);
    return $db->lastInsertId();
}

function addUserSkill($userID, $skillID) {
    global $db;
    $query = $db->prepare("SELECT * FROM User_Skill WHERE UserID = ? AND SkillID = ?");
    $query->execute([$userID,$skillID]);
    $result = $query->fetch();
    if (!$result) {
           $request = $db->prepare("INSERT INTO User_Skill (UserID, SkillID) VALUES (?, ?)");
    return $request->execute([$userID, $skillID]);
    }else {
        exit();
    }
 
}

function getUserSkills($userID) {
    global $db;
    $request = $db->prepare("
        SELECT us.SkillID AS ID, s.Name 
        FROM User_Skill us 
        JOIN Skill s ON us.SkillID = s.ID 
        WHERE us.UserID = ?
    ");
    $request->execute([$userID]);
    return $request->fetchAll(PDO::FETCH_ASSOC);
}


function updateBasicInfo($userID, $name, $number, $address, $description) {
    global $db;

    $stmt = $db->prepare('
        SELECT 
            User.Name,
            User.Phone_number,
            User.user_description,
            Localisation.Address_Name AS Address,
            User.Address_ID
        FROM User
        LEFT JOIN Localisation ON User.Address_ID = Localisation.ID
        WHERE User.ID = ?
    ');
    $stmt->execute([$userID]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    $name        = $name !== ''        ? $name        : $userData['Name'];
    $number      = $number !== ''      ? $number      : $userData['Phone_number'];
    $description = $description !== '' ? $description : $userData['user_description'];
    $address     = $address !== ''     ? $address     : $userData['Address'];

    $stmt = $db->prepare("INSERT INTO Localisation (Address_Name) VALUES (?)");
    $stmt->execute([$address]);
    $newAddressId = $db->lastInsertId();

    $stmt = $db->prepare("
        UPDATE User
        SET Name = ?, Phone_number = ?, user_description = ?, Address_ID = ?
        WHERE ID = ?
    ");
    $stmt->execute([$name, $number, $description, $newAddressId, $userID]);

    if (!empty($userData['Address_ID'])) {
        $stmt = $db->prepare("DELETE FROM Localisation WHERE ID = ?");
        $stmt->execute([$userData['Address_ID']]);
    }

    echo "<script>alert('Profil mis à jour avec nouvelle adresse.');</script>";
}




function deleteSkill($userID,$skillId) {
    global $db;
    $request = $db->prepare("DELETE FROM User_Skill WHERE UserID = ? AND SkillID = ?");
    $request->execute([$userID,$skillId]);
}

function deleteEducation($eduId) {
    global $db;
    $request = $db->prepare("DELETE FROM Education WHERE ID = ?");
    $request->execute([$eduId]);
}

function deleteExperience($expId) {
    global $db;
    $request = $db->prepare("DELETE FROM Experience WHERE ID = ?");
    $request->execute([$expId]);
}

function deleteDocument($docId) {
    global $db;
    $request = $db->prepare("DELETE FROM Media WHERE ID = ? AND Path LIKE '%.pdf'");
    $request->execute([$docId]);
}








