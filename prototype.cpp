#include <iostream>
#include <map>
#include <string>
#include <limits>
#include <algorithm> // For std::all_of

class Student {
public:
    std::string name;
    long long int registrationNumber;
    double accountBalance;

    Student(std::string n, long long int reg, double balance)
        : name(n), registrationNumber(reg), accountBalance(balance) {}

    // Student can view their account balance
    void viewAccountBalance() {
        std::cout << "Student Name: " << name << std::endl;
        std::cout << "Account Balance: " << accountBalance << std::endl;
    }
};

class Admin {
public:
    // Admin can register a new student
    static void registerStudent(std::map<long long int, Student>& students) {
        std::string name;
        long long int regNum;
        double balance;

        std::cout << "Enter student name: ";
        std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n'); // Clear the newline character
        std::getline(std::cin, name);

        while (true) {
            std::cout << "Enter student registration number (10 digits starting with 21 or 22): ";
            std::string regStr;
            std::cin >> regStr;

            // Check if the input contains only digits and has the correct length
            if (regStr.length() == 10 && std::all_of(regStr.begin(), regStr.end(), ::isdigit)) {
                regNum = std::stoll(regStr);
                if (isRegistrationValid(regNum)) {
                    break; // Valid registration number, exit the loop
                }
            }
            std::cout << "Invalid registration number. Please try again." << std::endl;
        }

        if (students.find(regNum) == students.end()) {
            std::cout << "Enter initial account balance: ";
            std::cin >> balance;
            students.emplace(regNum, Student(name, regNum, balance));
            std::cout << "Student registered successfully." << std::endl;
        } else {
            std::cout << "Student with the same registration number already exists. Registration failed." << std::endl;
        }
    }

    // Admin can update student details
    static void updateStudentDetails(std::map<long long int, Student>& students) {
        long long int regNum;
        std::cout << "Enter the student's registration number: ";
        std::cin >> regNum;
        auto it = students.find(regNum);

        if (it != students.end()) {
            std::string newName;
            std::cout << "Enter the new student name: ";
            std::cin.ignore(std::numeric_limits<std::streamsize>::max(), '\n'); // Clear the newline character
            std::getline(std::cin, newName);
            it->second.name = newName;
            std::cout << "Student details updated successfully." << std::endl;
        } else {
            std::cout << "Student not found. Update failed." << std::endl;
        }
    }

    // Admin can display the mess menu
    static void displayMessMenu() {
        std::cout << "------ Mess Menu ------" << std::endl;
        std::cout << "1. Breakfast - $10.0" << std::endl;
        std::cout << "2. Lunch - $20.0" << std::endl;
        std::cout << "3. Dinner - $30.0" << std::endl;
        std::cout << "-----------------------" << std::endl;
    }

    // Admin can display all students
    static void displayAllStudents(const std::map<long long int, Student>& students) {
        std::cout << "------ All Students ------" << std::endl;
        for (const auto& pair : students) {
            std::cout << "Registration Number: " << pair.first << std::endl;
            std::cout << "Student Name: " << pair.second.name << std::endl;
            std::cout << "Account Balance: " << pair.second.accountBalance << std::endl;
            std::cout << "-----------------------" << std::endl;
        }
    }

    // Admin can update a student's account balance
    static void updateStudentBalance(std::map<long long int, Student>& students) {
        long long int regNum;
        double payment;
        std::cout << "Enter the student's registration number: ";
        std::cin >> regNum;
        auto it = students.find(regNum);

        if (it != students.end()) {
            std::cout << "Enter the payment amount: ";
            std::cin >> payment;
            it->second.accountBalance += payment;
            std::cout << "Account balance updated successfully." << std::endl;
        } else {
            std::cout << "Student not found. Balance update failed." << std::endl;
        }
    }

    // Helper function to validate registration number
    static bool isRegistrationValid(long long int regNum) {
        std::string regStr = std::to_string(regNum);
        return regStr.length() == 10 && (regStr.substr(0, 2) == "21" || regStr.substr(0, 2) == "22");
    }
};

int main() {
    std::map<long long int, Student> students;
    auto it = students.end(); // Define it outside the switch statement

    while (true) {
        std::cout << "------ Main Menu ------" << std::endl;
        std::cout << "1. Admin Login" << std::endl;
        std::cout << "2. Student Login" << std::endl;
        std::cout << "3. Exit" << std::endl;
        std::cout << "------------------------" << std::endl;

        int loginChoice;
        std::cout << "Enter your choice: ";
        std::cin >> loginChoice;

        switch (loginChoice) {
            case 1:
                while (true) {
                    std::cout << "------ Admin Menu ------" << std::endl;
                    std::cout << "1. Register Student" << std::endl;
                    std::cout << "2. Update Student Details" << std::endl;
                    std::cout << "3. Update Student Balance" << std::endl;
                    std::cout << "4. Display Mess Menu" << std::endl;
                    std::cout << "5. Exit" << std::endl;
                    std::cout << "6. Display All Students" << std::endl;
                    std::cout << "------------------------" << std::endl;

                    int choice;
                    std::cout << "Enter your choice: ";
                    std::cin >> choice;

                    switch (choice) {
                        case 1:
                            Admin::registerStudent(students);
                            break;
                        case 2:
                            Admin::updateStudentDetails(students);
                            break;
                        case 3:
                            Admin::updateStudentBalance(students);
                            break;
                        case 4:
                            Admin::displayMessMenu();
                            break;
                        case 5:
                            std::cout << "Exiting Admin Menu... " << std::endl;
                            it = students.end(); // Reset the iterator when exiting admin menu
                            break;
                        case 6:
                            Admin::displayAllStudents(students);
                            break;
                        default:
                            std::cout << "Invalid choice. Please try again." << std::endl;
                    }

                    if (choice == 5) {
                        break; // Exit the admin menu and return to the main menu
                    }
                }
                break;
            case 2:
                // Student Login
                long long int regNum;
                std::cout << "Enter your registration number: ";
                std::cin >> regNum;
                it = students.find(regNum);

                if (it != students.end()) {
                    while (true) {
                        std::cout << "------ Student Menu ------" << std::endl;
                        std::cout << "1. View Account Balance" << std::endl;
                        std::cout << "2. View Mess Menu" << std::endl;
                        std::cout << "3. Exit" << std::endl;
                        std::cout << "------------------------" << std::endl;

                        int choice;
                        std::cout << "Enter your choice: ";
                        std::cin >> choice;

                        switch (choice) {
                            case 1:
                                it->second.viewAccountBalance();
                                break;
                            case 2:
                                Admin::displayMessMenu();
                                break;
                            case 3:
                                std::cout << "Exiting Student Menu... " << std::endl;
                                it = students.end(); // Reset the iterator when exiting student menu
                                break;
                            default:
                                std::cout << "Invalid choice. Please try again." << std::endl;
                        }

                        if (choice == 3) {
                            break; // Exit the student menu and return to the main menu
                        }
                    }
                } else {
                    std::cout << "Student not found. Please enter a valid registration number." << std::endl;
                }
                break;
            case 3:
                std::cout << "Exiting... " << std::endl;
                return 0;
            default:
                std::cout << "Invalid choice. Please try again." << std::endl;
        }
    }

    return 0;
}