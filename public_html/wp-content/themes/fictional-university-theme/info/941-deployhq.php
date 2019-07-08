click NewProject
select bitbucket service
click Create Project.
click on fictional university // githubo or bitbucket project.

Type deployment ServerName
click protocol =SSH/SFTP. donot use FTP as not secure.

setup SSH Configuration.
hostname: ftp.brads.sgedu.site
port: 18765
UserName: can be found from siteground->cpanel and ftp username.
Password: instead use SSH key rather than password. copy SSH key from deployhq.com and paste in  -> siteground->cpanel->home -> advanced section->ssh shell access -> upload SSH key.
Deployment Path: public_html/       //might be different for different hostings.

Deployment Options -> Branch to deploy from -> master.
 (possible to have Dev/staging/live/production branches).

      Staging brance: you and client know about.
      Dev branch: for developer.
      production: for real deployment hosting account.

sub directory to deploy from : app/    //in a vagrant setup, the path on the machine will be.

Click Create server.

Step:
now click deployments from left tree. and click new deployment button over right side.

click Deploy button

step:
now go to siteGroundControlPanel and add database user and give all the privilleges to the database in mysql Account maintainance. and click make changes.

-------------automatic deployment----------------------
goto deployhq.com
from left tree, select Servers & Groups.
there will be only one server Siteground. Click Edit beside ssh icon.
go to the bottom and select Enable auto deployments. Copy the url from the text box there.

gooto bitbucket.org repository and go to settings.
click on Webhooks from sub-left tree.
click add a webhook.
past the copyied url from delployhq.com, set Title, status =active, triggers =repository push and click save.

----practicle.
change Headline: Hello World in front-page.php
in header.php change Campuses to locations.

now goto commandprompt git:(master):
git add -A  //commit changes.
git status
git push origin master

the changes have deployed to the live server and can see the deployment history ove deployhq.com










