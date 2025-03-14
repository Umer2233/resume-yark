<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FieldTipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field_tips = array(
            array('id' => '1', 'page' => 'StartResume', 'field' => 'termsCheckbox', 'type' => '1', 'tip' => 'I heard you have to give away your first-born child to use this site, so you better read these carefully!', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '2', 'page' => 'contactInfo', 'field' => 'firstName', 'type' => '1', 'tip' => 'Feel free to use your nickname as long as it doesn\'t detract from the rest of your resume', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '3', 'page' => 'contactInfo', 'field' => 'streetaddress', 'type' => '1', 'tip' => 'I am 50/50 on whether you actually need to include your street address on your resume. You can always enter it here and exclude it from your resume later. ', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '10', 'page' => 'contactInfo', 'field' => 'profile', 'type' => '1', 'tip' => 'It is a good practice to include a link to LinkedIn, Behance or another site where recruiters can learn more about your <strong>professional</strong> profile', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '11', 'page' => 'workhistory', 'field' => 'position', 'type' => '1', 'tip' => 'If the bulk of your experience is with one employer, you may consider adding the employer multiple times to illustrate the different positions you have held and when you held them. However, if you already have several employers, consider just using the most recent position.', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '12', 'page' => 'workhistory', 'field' => 'PositionClassification', 'type' => '1', 'tip' => 'Pick the classification that fits best. We will later match up the responsibilities for this position with the position you are applying for.', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '13', 'page' => 'contactInfo', 'field' => 'email', 'type' => '1', 'tip' => 'Please use a professional email address for one person. ladiesman342@gmail.com may be fine for your friends (actually you should probably stop using it altogether), but please don\'t use it on your resume. Please! The same can be said for an email address like bill.and.jill@gmail.com. Sign up for your own email address - even if it is just used to hunt for jobs.', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '14', 'page' => 'contactInfo', 'field' => 'phone', 'type' => '1', 'tip' => 'Ideally use a phone that you will answer. Make sure the voicemail message is professional.', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '15', 'page' => 'contactInfo', 'field' => 'website', 'type' => '1', 'tip' => 'You will want to include a link if you’ve created a professional website to showcase your expertise and accomplishments. <br> However, don\'t include a link to your website if it isn\'t relevant to the jobs you are applying for. I don\'t care how proud you are of your Harry Potter blog, if it isn\'t relevant, don\'t include it!', 'created_at' => '2019-11-17 18:30:00', 'updated_at' => '2019-11-17 18:30:00'),
            array('id' => '16', 'page' => 'education', 'field' => 'educationSchool', 'type' => '1', 'tip' => 'Select from our list of US schools or type your school in manually', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00'),
            array('id' => '17', 'page' => 'education', 'field' => 'educationDegree', 'type' => '1', 'tip' => 'Select the highest degree you obtained at this school. You may add the same school twice if you want to show that you received more than one degree.', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00'),
            array('id' => '18', 'page' => 'education', 'field' => 'educationGradmonth', 'type' => '1', 'tip' => 'Select the month you graduated', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00'),
            array('id' => '19', 'page' => 'education', 'field' => 'educationGraddate', 'type' => '1', 'tip' => 'Please enter Graduation date', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00'),
            array('id' => '20', 'page' => 'education', 'field' => 'educationMajor', 'type' => '1', 'tip' => 'Input your major or field of study', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00'),
            array('id' => '21', 'page' => 'education', 'field' => 'educationOtherDegree', 'type' => '1', 'tip' => 'If you completed your degree in another country, you may want to explain what the equivalent degree is in parenthesis.', 'created_at' => '2020-07-29 00:00:00', 'updated_at' => '2020-07-29 00:00:00'),
            array('id' => '22', 'page' => 'education enhancements', 'field' => 'Minor', 'type' => '1', 'tip' => 'Just add the title of the minor. Don\'t add the word "minor" in the text. We\'ll do that for you.', 'created_at' => '2020-09-24 00:00:00', 'updated_at' => '2020-09-24 00:00:00'),
            array('id' => '23', 'page' => 'education enhancements', 'field' => 'CreditsCompleted', 'type' => '1', 'tip' => 'Feel free to add more detail here like what type of degree (ie. bachelors) you were pursuing. It is also appropriate to weave in why you didn\'t complete your degree if it isn\'t too personal', 'created_at' => '2020-09-24 00:00:00', 'updated_at' => '2020-09-24 00:00:00'),
            array('id' => '24', 'page' => 'education enhancements', 'field' => 'SocietiesClubsandOrganizations  ', 'type' => '1', 'tip' => 'This is a great area to highlight any student leadership roles you have filled, but you can also just highlight the fact that you were involved in any societies, clubs or organizations. The more relevant the organization to the position you are applying for, the better', 'created_at' => '2020-09-24 00:00:00', 'updated_at' => '2020-09-24 00:00:00'),
            array('id' => '25', 'page' => 'education enhancements', 'field' => 'HonorsAndAcademicAchievements  ', 'type' => '1', 'tip' => 'Bragging is not a bad thing when it comes to resumes. Highlight your academic achievements like making the honor roll, etc. Indicating that you graduated early is also appropriate here.', 'created_at' => '2020-09-24 00:00:00', 'updated_at' => '2020-09-24 00:00:00'),
            array('id' => '26', 'page' => 'education', 'field' => 'educationGradyear', 'type' => '1', 'tip' => 'Select the year you graduated', 'created_at' => '2020-05-14 00:00:00', 'updated_at' => '2020-05-14 00:00:00')
        );

        foreach($field_tips as $field){
            DB::table('field_tips')->insert($field);
        }
    }
}
