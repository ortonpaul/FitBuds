# Pickhacks 2019 Entry: FitBuds
## Inspiration
We wanted FitBuds to not only be a unique service, but also one that served an overlooked segment of the population: senior citizens. According to the CDC, physically active older adults should incorporate around 2.5 hours of moderate endurance activity into their weeks to preserve physical function and mobility. However, more than 2/3 of adults do not reach this number.

Compounding this problem, most athletics programs overlook the needs of senior citizens and don’t properly encourage healthy and safe exercise habits. This is especially important considering the impact of exercise on reducing the severity/frequency of falls, and the power of exercise to reduce the risk of osteoarthritis, osteoporosis, cardiovascular disease, and type 2 diabetes (all of which are chronic conditions that many older adults face).

With those goals in mind, we decided we wanted to create an easy-to-use and intuitive service that assists the elderly in tracking, managing, and even improving their health. Hence, FitBuds aims to be simple, functionally reliable, and informative.

## What it does
FitBuds tracks the “aptitudes” of users through a mobile app and through surveys on the website. The mobile app tracks the movements of an individual and uses the data collected to compute a score for three aptitudes: strength, balance, and flexibility (the major components of physical health). These can indicate the risks of developing conditions. Lifestyle information gathered through the web app also play a part in this evaluation. 

Machine learning analyzes this data and then recommends the best type of exercise to address deficient areas. The app, however, goes even further and also uses the current location of user to find nearby gyms and senior service centers with active wellness programs for older adults or low-impact exercises like yoga and swimming. Users can then improve their health and track their progress, along with possibly receiving reminder alerts or nutritional tips (another major concern around the health of older adults). 

## How we built it
The site is served by an Apache/MySQL host. Using a combination of HTML, CSS, PHP, JavaScript, and MySQL, the web app allows users to create accounts and securely store their health information and personal history. In addition, an iOS app (written in Swift with Cocoapods in Ruby) works in tandem with the site through a RESTful API and QR code login system. As a result, user do not have to remember their passwords in order to securely update their analytics — a critical feature to allow adults with lower digital literacy to still take advantage of the service. The app also implements supervised machine learning through support vector machines with a RDF kernel trained in Python (more detail on the trial and error around the neural networks for the more technically minded folks at the end of this doc).


## Challenges we ran into
One of the largest issues we encountered was the unexpected intricacy involved in creating a seamless experience for users across platforms. Transferring data from a mobile app to a web app required quite a bit of research as well as trial and error. Understanding some of the logic that needed to be implemented, whether in function calls, parameter names, or even design processes, turned out to be overwhelming at times. Additionally, an issue with version control about halfway through the project set us back a bit. Through adversity like this, however, we were able to create a more robust project that will prove to be more impactful on users.

## Accomplishments or moments that we’re proud of
* The moment I’m most proud of is when our machine learning code started to correctly label the various conditions of stability after spending a bunch of time recording example data and fiddling with it. **-Morgen**
* I’m proud of our teamwork skills. We worked well as a team and we all stepped up as leaders to help make the project a success. **-Calvin**
* My proudest moment was being able to contribute to a really cool project even if it wasn’t something I’d had experience in because it really excites me for my future in CS! **-Paul**
* I’m proud of the seamless integration between the iOS app and the web app, along with the machine learning work. **-David**

## What we learned
* I learned a lot about machine learning, how it processes data, and how we can effectively apply it to fit our needs and simplify the problems we were facing. **-Morgen**
* I learned just how deceptively complex some websites can be, and how they can implement several languages. I also learned how to ask for help and communicate what I am trying to accomplish to others. **-Calvin**
* I learned how crucial both front- and back-end web development are no matter what kind of project you’re creating. **-Paul**
* SO MUCH about matrices and machine learning. Like my brain literally hurts. **-David**

## Future plans for FitBuds
In the future, we’d like to add a wider range of exercise monitoring tests and increase the sample to create more accurate and helpful predictions. We would also use the data about the presence of older adult active wellness resources to help find areas that are deficient. Then, we could lobby to have more senior services centers available and resources for the physical and nutritional health of older adults.

> ### Designing the machine learning (on the technical side)
> Machine learning is more about tuning algorithms, features, and parameters to generate the best data over anything else. This was also the first time anyone on the team had used scikit-learn/machine learning. We created a separate iOS app just for experimenting with the ways to generate and manipulate the x, y, and z acceleration before inputting into different Python neural network training scripts. Since we were gathering time-based data from the three directions, we originally decided to work worth unsupervised learning just to characterize the data. We started with PCA (Principal Component Analysis) to understand the clustering of the data, but then decided to move to supervised learning based on our inputted classification of the data. Although many resources recommended the KNeighbors classifier, the model could not handle the large number of dimensions in our data. We tried to condense the data (using techniques like the average of the the magnitudes of the acceleration in each direction), but it caused us to lose too much information. While we did consider implementing dimensionality reduction, we would have had to move back to a PCA model. In the end, our tests indicated that support vector machines returned the best results. The SVM was effective with high dimensional spaces and we could still manipulate the gamma and kernel function used.

> Unfortunately, when we tried to port our model to the iOS, we had reconfigure to work within the constraints of the coremltools (the Apple framework that converts from SVM to Core ML) since it wasn’t compatible with versions higher than Python 2.7. So, we had two different instances of Python running in parallel - one to best generate the model in the newer tools and one that created a Core ML compatible neural network.
