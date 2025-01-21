<?php
include_once 'Easy.php';
class Course
{
    use Easy;
    private $id;
    private $title;
    private $description;
    private $content;
    private $tags = [];
    private $tagsHtml;
    private $categorie;
    private $students = [];
    private $teacher;
    private $db;
    private $totalStudents;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getId() {
        return $this->id;
    }
    public function getTagsHtml() {
        return $this->tagsHtml;
    }
    public function encode()
    {
        return json_encode($this);
    }
    // Getter for $title
    public function getTitle() {
        return $this->title;
    }

    // Getter for $description
    public function getDescription() {
        return $this->description;
    }

    // Getter for $content
    public function getContent() {
        return $this->content;
    }

    // Getter for $tags
    public function getTags() {
        return $this->tags;
    }

    // Getter for $categorie
    public function getCategorie() {
        return $this->categorie;
    }

    // Getter for $students
    public function getStudents() {
        return $this->students;
    }

    // Getter for $teacher
    public function getTeacher() {
        return $this->teacher;
    }

    // Getter for $totalStudents
    public function getTotalStudents() {
        return $this->totalStudents;
    }
    // public static function getall($db)
    // {
    //     $db->query('select * from courses');
    // }
    public function search($courseName)
    {
        $stmnt = "select courses.title,
        courses.description, 
        tags.name as tagname, 
        courses.id, 
        course_tags.course_id, 
        tags.id as tag_id, 
        users.username as teacher, 
        categories.name as categorie
        from course_tags
        join tags on course_tags.tag_id  = tags.id 
        join courses on courses.id = course_tags.course_id 
        join categories on courses.category_id = categories.id 
        join users on teacher_id = users.id 
        WHERE courses.title = ?;";
        $result = $this->secureQuery($this->db, $stmnt, [$courseName]);
        if (empty($result)){
            $this->redirect("http://localhost:8000/notfound.php");
            exit();
        }
        // print_r($result);
        $this->id = $result[0]['course_id'];
        $this->title = $result[0]['title'];
        $this->description = $result[0]['description'];
        $this->categorie = $result[0]['categorie'];
        $this->teacher = $result[0]['teacher'];
        $this->totalStudents = count($result);

        $stmnt = "select courses.title, tags.name as tag_name from course_tags 
        join courses on courses.id = course_tags.course_id 
        join tags on tags.id = course_tags.tag_id 
        where courses.title = ?";
        $result = $this->secureQuery($this->db, $stmnt, [$this->title]);

        $this->tags =  $result;
    }
    public function renderTags()
    {
        for ($i = 0; $i < count($this->tags); $i++)
        {
            // $arr = $tags;
            $arr = $this->tags;
            $tag = $arr[$i]['tag_name'];
            $this->tagsHtml .= "<span class='inline-block bg-blue-500 text-white rounded-full px-3 py-1 text-sm mr-2'>$tag</span>";
        }
    }
    public static function getRandomCourses($db)
    {
        $result = Course::secureQuery($db, "select * from courses order by rand() limit 3;");
        $popular = '';
        foreach ($result as $row) {
            $title = $row['title'];
            $description = $row['description'];
            $title= $row['title'];
            $popular .=  "<div class='bg-white p-4 rounded-lg shadow'>
            <h3 class='font-semibold text-xl font-semibold text-blue-600 p-2'>$title</h3>
            <p class='text-gray-600'>$description</p>
            <a href='http://localhost:8000/courses.php/?course=$title' class='text-blue-600 hover:underline'>View Course</a></div>";
        }
        return $popular;
    }
}
